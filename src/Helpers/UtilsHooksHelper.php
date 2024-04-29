<?php

/**
 * Class that holds all hooks helpers.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

use EightshiftFormsUtils\Config\UtilsConfig;
use EightshiftLibs\Helpers\Helpers;

/**
 * Class UtilsHooksHelper
 */
final class UtilsHooksHelper
{
	/**
	 * Get public filter name.
	 *
	 * @param array<int, string> $names Array of names.
	 * @param array<mixed> $data Array of data.
	 * @param string $filterPrefix Filter prefix.
	 *
	 * @return string
	 */
	public static function getFilterName(array $names, array $data = [], string $filterPrefix = UtilsConfig::FILTER_PREFIX): string
	{
		if (!$data) {
			$data = \EIGHTSHIFT_FORMS[UtilsConfig::PUBLIC_FILTERS_NAME]; // @phpstan-ignore-line
		}

		return self::getHookName($names, 'filters', 'filter', $data, $filterPrefix);
	}

	/**
	 * Get public action name.
	 *
	 * @param array<int, string> $names Array of names.
	 * @param array<mixed> $data Array of data.
	 * @param string $filterPrefix Filter prefix.
	 *
	 * @return string
	 */
	public static function getActionName(array $names, array $data = [], string $filterPrefix = UtilsConfig::FILTER_PREFIX): string
	{
		if (!$data) {
			$data = \EIGHTSHIFT_FORMS[UtilsConfig::PUBLIC_ACTIONS_NAME]; // @phpstan-ignore-line
		}

		return self::getHookName($names, 'actions', 'action', $data, $filterPrefix);
	}

	/**
	 * Build a full filter name from array of names.
	 *
	 * @param array<int, string> $names Array of names.
	 * @param string $cacheName Cache name.
	 * @param string $label Label.
	 * @param array<mixed> $dataSet Data set.
	 * @param string $filterPrefix Filter prefix.
	 *
	 * @return string
	 */
	private static function getHookName(array $names, string $cacheName, string $label, array $dataSet, string $filterPrefix = UtilsConfig::FILTER_PREFIX): string
	{
		$output = \wp_cache_get($filterPrefix . "_{$cacheName}_public_list", $filterPrefix);

		// Cache filter names for faster access.
		if (!$output) {
			$output = self::getHooksList($dataSet, '', $filterPrefix);

			\wp_cache_add($filterPrefix . "_{$cacheName}_public_list", $output, $filterPrefix, \HOUR_IN_SECONDS);
		}

		// List of all keys provided for the filter name.
		$names = \array_map(
			function ($item) {
				return Helpers::kebabToSnakeCase(Helpers::camelToSnakeCase($item));
			},
			$names
		);

		// Create a string from array.
		$names = \implode('_', $names);

		// Create a full filter name.
		$outputName = $filterPrefix . "_{$names}";

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
	 * @param string $filterPrefix Filter prefix.
	 *
	 * @return array<int, string>
	 */
	private static function getHooksList(array $data, string $prefix = '', string $filterPrefix = UtilsConfig::FILTER_PREFIX): array
	{
		$output = [];

		foreach ($data as $key => $value) {
			if (\is_array($value)) {
				$nestedKeys = self::getHooksList($value, $prefix . Helpers::kebabToSnakeCase(Helpers::camelToSnakeCase($key)) . '_', $filterPrefix);
				$output = \array_merge($output, $nestedKeys);
			} else {
				$output[] = $filterPrefix . '_' . $prefix . Helpers::kebabToSnakeCase(Helpers::camelToSnakeCase($value));
			}
		}

		return $output;
	}
}
