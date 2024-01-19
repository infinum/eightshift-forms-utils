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
final class UtilsMain
{
	/**
	 * Check if main plugin is active.
	 *
	 * @param string $name Name of the plugin.
	 *
	 * @return void
	 */
	public static function checkAddonPlugins(string $name): void
	{
		if (!\is_plugin_active(UtilsConfig::MAIN_PLUGIN_FULL_NAME) && !empty($name)) {
			\deactivate_plugins($name);
		}
	}

	/**
	 * Check if main plugin is active if not set a notice.
	 *
	 * @param string $name Name of the plugin.
	 *
	 * @return void
	 */
	public static function checkAddonPluginsNotice(string $name): void
	{
		if (!\is_plugin_active(UtilsConfig::MAIN_PLUGIN_FULL_NAME) && !empty($name)) {
			// translators: %s is replaced with plugin name.
			echo '<div class="notice notice-error"><p>' . \sprintf(\esc_html__('Eightshift Forms - Addon %s plugin requires Eightshift Forms plugin. Please activate Eightshift Forms plugin first.', 'eightshift-forms-addon-computed-fields'), \esc_html($name)) . '</p></div>';
		}
	}
}
