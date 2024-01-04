<?php

/**
 * The file that defines the project entry point class.
 *
 * A class definition that includes attributes and functions used across both the
 * public side of the site and the admin area.
 *
 * @package EightshiftFormsUtils\Config
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Config;

/**
 * The project config class.
 */
class UtilsConfig
{
	/**
	 * Prefix added to all filters.
	 *
	 * @var string
	 */
	public const FILTER_PREFIX = 'es_forms';

	/**
	 * Filter name triggered when main forms plugins is loaded.
	 *
	 * @var string
	 */
	public const FILTER_LOADED_NAME = self::FILTER_PREFIX . '_loaded';

	/**
	 * Settings internal types.
	 *
	 * @var string
	 */
	public const SETTINGS_INTERNAL_TYPE_GENERAL = 'sidebar-general';
	public const SETTINGS_INTERNAL_TYPE_INTEGRATION = 'sidebar-integration';
	public const SETTINGS_INTERNAL_TYPE_TROUBLESHOOTING = 'sidebar-troubleshooting';
	public const SETTINGS_INTERNAL_TYPE_MISCELLANEOUS = 'sidebar-miscellaneous';
	public const SETTINGS_INTERNAL_TYPE_ADVANCED = 'sidebar-advanced';
	public const SETTINGS_INTERNAL_TYPE_ADDON = 'sidebar-addon';

	/**
	 * Delimiter used in checkboxes and multiple items.
	 *
	 * @var string
	 */
	public const DELIMITER = '---';

	public const SETTINGS_NAME_PREFIX = 'es-forms';

	public const FILTER_SETTINGS_DATA = self::FILTER_PREFIX . '_settings_data';
	public const FILTER_SETTINGS_NONE_TRANSLATABLE_NAMES = self::FILTER_PREFIX . '_settings_none_translatable_names';

	/**
	 * Method that returns projects temp upload dir name.
	 *
	 * @return string
	 */
	public static function getTempUploadDir(): string
	{
		return "esforms-tmp";
	}
}
