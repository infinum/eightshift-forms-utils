<?php

/**
 * Class that holds all developer helpers.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

use EightshiftFormsUtils\Config\UtilsConfig;

/**
 * Class UtilsDeveloperHelper
 */
final class UtilsDeveloperHelper
{
	/**
	 * Check if developer debugging is active.
	 *
	 * @return boolean
	 */
	public static function isDeveloperDebuggingActive(): bool
	{
		return \apply_filters(UtilsConfig::FILTER_SETTINGS_IS_DEBUG_ACTIVE, UtilsConfig::SETTINGS_DEBUG_DEBUGGING_KEY) ?? false;
	}

	/**
	 * Check if developer skip form validation is active.
	 *
	 * @return boolean
	 */
	public static function isDeveloperSkipFormValidationActive(): bool
	{
		return \apply_filters(UtilsConfig::FILTER_SETTINGS_IS_DEBUG_ACTIVE, UtilsConfig::SETTINGS_DEBUG_SKIP_VALIDATION_KEY) ?? false;
	}

	/**
	 * Check if developer skip form reset is active.
	 *
	 * @return boolean
	 */
	public static function isDeveloperSkipFormResetActive(): bool
	{
		return \apply_filters(UtilsConfig::FILTER_SETTINGS_IS_DEBUG_ACTIVE, UtilsConfig::SETTINGS_DEBUG_SKIP_RESET_KEY) ?? false;
	}

	/**
	 * Check if developer skip captcha is active.
	 *
	 * @return boolean
	 */
	public static function isDeveloperSkipCaptchaActive(): bool
	{
		return \apply_filters(UtilsConfig::FILTER_SETTINGS_IS_DEBUG_ACTIVE, UtilsConfig::SETTINGS_DEBUG_SKIP_CAPTCHA_KEY) ?? false;
	}

	/**
	 * Check if developer skip forms sync is active.
	 *
	 * @return boolean
	 */
	public static function isDeveloperSkipFormsSyncActive(): bool
	{
		return \apply_filters(UtilsConfig::FILTER_SETTINGS_IS_DEBUG_ACTIVE, UtilsConfig::SETTINGS_DEBUG_SKIP_FORMS_SYNC_KEY) ?? false;
	}

	/**
	 * Check if developer skip cache is active.
	 *
	 * @return boolean
	 */
	public static function isDeveloperSkipCacheActive(): bool
	{
		return \apply_filters(UtilsConfig::FILTER_SETTINGS_IS_DEBUG_ACTIVE, UtilsConfig::SETTINGS_DEBUG_SKIP_CACHE_KEY) ?? false;
	}

	/**
	 * Check if developer mode is active.
	 *
	 * @return boolean
	 */
	public static function isDeveloperModeActive(): bool
	{
		return \apply_filters(UtilsConfig::FILTER_SETTINGS_IS_DEBUG_ACTIVE, UtilsConfig::SETTINGS_DEBUG_DEVELOPER_MODE_KEY) ?? false;
	}

	/**
	 * Check if QA Monitor Log mode is active.
	 *
	 * @return boolean
	 */
	public static function isDeveloperQMLogActive(): bool
	{
		return \apply_filters(UtilsConfig::FILTER_SETTINGS_IS_DEBUG_ACTIVE, UtilsConfig::SETTINGS_DEBUG_QM_LOG) ?? false;
	}

	/**
	 * Check if Force Disabled Fields mode is active.
	 *
	 * @return boolean
	 */
	public static function isDeveloperForceDisabledFieldsActive(): bool
	{
		return \apply_filters(UtilsConfig::FILTER_SETTINGS_IS_DEBUG_ACTIVE, UtilsConfig::SETTINGS_DEBUG_FORCE_DISABLED_FIELDS) ?? false;
	}

	/**
	 * Set and output data to output log using Query Monitor plugin.
	 *
	 * @param mixed $data Data to output.
	 *
	 * @return void
	 */
	public static function setQmLogsOutput($data = ''): void
	{
		if (\is_plugin_active('query-monitor/query-monitor.php') && UtilsDeveloperHelper::isDeveloperQMLogActive() && $data) {
			\do_action('qm/debug', $data); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
		}
	}
}
