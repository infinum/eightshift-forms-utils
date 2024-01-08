<?php

/**
 * Class that holds all hooks helpers.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

use EightshiftFormsUtils\Config\UtilsConfig;

/**
 * Class UtilsHooksHelper
 */
final class UtilsHooksHelper
{
	/**
	 * Get public filter name.
	 *
	 * @param array<int, string> $names Array of names.
	 *
	 * @return string
	 */
	public static function getFilterName(array $names): string
	{
		return self::getHookName($names, 'filters', 'filter', \apply_filters(UtilsConfig::FILTER_PUBLIC_FILTERS_DATA, []));
	}

	/**
	 * Get public action name.
	 *
	 * @param array<int, string> $names Array of names.
	 *
	 * @return string
	 */
	public static function getActionName(array $names): string
	{
		return self::getHookName($names, 'actions', 'action', \apply_filters(UtilsConfig::FILTER_PUBLIC_ACTIONS_DATA, []));
	}

	/**
	 * Build a full filter name from array of names.
	 *
	 * @param array<int, string> $names Array of names.
	 * @param string $cacheName Cache name.
	 * @param string $label Label.
	 * @param array<mixed> $dataSet Data set.
	 *
	 * @return string
	 */
	private static function getHookName(array $names, string $cacheName, string $label, array $dataSet): string
	{
		$output = \wp_cache_get(UtilsConfig::FILTER_PREFIX . "_{$cacheName}_public_list", UtilsConfig::FILTER_PREFIX);

		// Cache filter names for faster access.
		if (!$output) {
			$output = self::getHooksList($dataSet);

			\wp_cache_add(UtilsConfig::FILTER_PREFIX . "_{$cacheName}_public_list", $output, UtilsConfig::FILTER_PREFIX, \HOUR_IN_SECONDS);
		}

		// List of all keys provided for the filter name.
		$names = \array_map(
			function ($item) {
				return UtilsGeneralHelper::kebabToSnakeCase(UtilsGeneralHelper::camelToSnakeCase($item));
			},
			$names
		);

		// Create a string from array.
		$names = \implode('_', $names);

		// Create a full filter name.
		$outputName = UtilsConfig::FILTER_PREFIX . "_{$names}";

		if (!\in_array($outputName, $output, true)) {
			// translators: %s is the filter name.
			\trigger_error(\sprintf(\esc_html__('You are using `%1$s` %2$s that doesn\'t exist. Please check the documentation for the correct action name!', 'eightshift-forms'), \esc_attr($outputName), \esc_attr($label)), \E_USER_WARNING); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
			return '';
		}

		return $outputName;
	}

	/**
	 * Get list of all full filter names build from array.
	 *
	 * @param array<mixed> $data Array of data.
	 * @param string $prefix Prefix to add to all filter names.
	 *
	 * @return array<int, string>
	 */
	private static function getHooksList(array $data, string $prefix = ''): array
	{
		$output = [];

		foreach ($data as $key => $value) {
			if (\is_array($value)) {
				$nestedKeys = self::getHooksList($value, $prefix . UtilsGeneralHelper::kebabToSnakeCase(UtilsGeneralHelper::camelToSnakeCase($key)) . '_');
				$output = \array_merge($output, $nestedKeys);
			} else {
				$output[] = UtilsConfig::FILTER_PREFIX . '_' . $prefix . UtilsGeneralHelper::kebabToSnakeCase(UtilsGeneralHelper::camelToSnakeCase($value));
			}
		}

		return $output;
	}
}
