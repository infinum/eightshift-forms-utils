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
		$filters = \wp_cache_get(UtilsConfig::FILTER_PREFIX . '_filters_public_list', UtilsConfig::FILTER_PREFIX);

		// Cache filter names for faster access.
		if (!$filters) {
			$filters = self::getAllPublicFiltersNames(\apply_filters(UtilsConfig::FILTER_PUBLIC_FILTERS_DATA, []));

			\wp_cache_add(UtilsConfig::FILTER_PREFIX . '_filters_public_list', $filters, UtilsConfig::FILTER_PREFIX, \HOUR_IN_SECONDS);
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
		$filterName = UtilsConfig::FILTER_PREFIX . "_{$names}";

		if (!\in_array($filterName, $filters, true)) {
			// translators: %s is the filter name.
			\trigger_error(\sprintf(\esc_html__("You are using `%s` filter that doesn't exist. Please check the documentation for the correct filter name!", 'eightshift-forms'), \esc_attr($filterName)), \E_USER_WARNING); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
			return '';
		}

		return $filterName;
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
		$actions = \wp_cache_get(UtilsConfig::FILTER_PREFIX . '_actions_public_list', UtilsConfig::FILTER_PREFIX);

		// Cache filter names for faster access.
		if (!$actions) {
			$actions = self::getAllPublicFiltersNames(\apply_filters(UtilsConfig::FILTER_PUBLIC_ACTIONS_DATA, []));

			\wp_cache_add(UtilsConfig::FILTER_PREFIX . '_actions_public_list', $actions, UtilsConfig::FILTER_PREFIX, \HOUR_IN_SECONDS);
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
		$actionName = UtilsConfig::FILTER_PREFIX . "_{$names}";

		if (!\in_array($actionName, $actions, true)) {
			// translators: %s is the filter name.
			\trigger_error(\sprintf(\esc_html__("You are using `%s` action that doesn't exist. Please check the documentation for the correct action name!", 'eightshift-forms'), \esc_attr($actionName)), \E_USER_WARNING); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
			return '';
		}

		return $actionName;
	}

	/**
	 * Get list of all full filter names build from array.
	 *
	 * @param array<mixed> $data Array of data.
	 * @param string $prefix Prefix to add to all filter names.
	 *
	 * @return array<int, string>
	 */
	private static function getAllPublicFiltersNames(array $data, string $prefix = ''): array
	{
		$output = [];

		foreach ($data as $key => $value) {
			if (\is_array($value)) {
				$nestedKeys = self::getAllPublicFiltersNames($value, $prefix . UtilsGeneralHelper::kebabToSnakeCase(UtilsGeneralHelper::camelToSnakeCase($key)) . '_');
				$output = \array_merge($output, $nestedKeys);
			} else {
				$output[] = UtilsConfig::FILTER_PREFIX . '_' . $prefix . UtilsGeneralHelper::kebabToSnakeCase(UtilsGeneralHelper::camelToSnakeCase($value));
			}
		}

		return $output;
	}
}
