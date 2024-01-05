<?php

/**
 * The file that defines the project entry point class.
 *
 * @package EightshiftFormsUtils\Main
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Main;

use EightshiftFormsUtils\Config\UtilsConfig;

/**
 * The project config class.
 */
class UtilsMain
{
	/**
	 * Check if main plugin is active.
	 *
	 * @return void
	 */
	public function checkAddonPlugins(): void
	{
		$name = \apply_filters(UtilsConfig::FILTER_ADDON_FULL_NAME, '');

		if (!\is_plugin_active(UtilsConfig::MAIN_PLUGIN_NAME) && !empty($name)) {
			\deactivate_plugins($name);
		}
	}

	/**
	 * Check if main plugin is active if not set a notice.
	 *
	 * @return void
	 */
	public function checkAddonPluginsNotice(): void
	{
		$name = \apply_filters(UtilsConfig::FILTER_ADDON_NAME, '');

		if (!\is_plugin_active(UtilsConfig::MAIN_PLUGIN_NAME) && !empty($name)) {
			// translators: %s is replaced with plugin name.
			echo '<div class="notice notice-error"><p>' . \sprintf(\esc_html__('Eightshift Forms - Addon %s plugin requires Eightshift Forms plugin. Please activate Eightshift Forms plugin first.', 'eightshift-forms-addon-computed-fields'), \esc_html($name)) . '</p></div>';
		}
	}
}
