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

	/**
	 * Status error const.
	 *
	 * @var string
	 */
	public const STATUS_ERROR = 'error';

	/**
	 * Status success const.
	 *
	 * @var string
	 */
	public const STATUS_SUCCESS = 'success';

	/**
	 * Status warning const.
	 *
	 * @var string
	 */
	public const STATUS_WARNING = 'warning';

	public const ROUTE_NAMESPACE = 'eightshift-forms';
	public const ROUTE_VERSION = 'v1';

	public const SETTINGS_NAME_PREFIX = 'es-forms';

	public const FILTER_SETTINGS_DATA = self::FILTER_PREFIX . '_settings_data';
	public const FILTER_PUBLIC_FILTERS_DATA = self::FILTER_PREFIX . '_public_filters_data';
	public const FILTER_SETTINGS_NONE_TRANSLATABLE_NAMES = self::FILTER_PREFIX . '_settings_none_translatable_names';

	public const INTEGRATION_TYPE_DEFAULT = 'default';
	public const INTEGRATION_TYPE_NO_BUILDER = 'no-builder';
	public const INTEGRATION_TYPE_COMPLEX = 'complex';

	/**
	 * API validator output key.
	 *
	 * @var string
	 */
	public const VALIDATOR_OUTPUT_KEY = 'validation';

	/**
	 * Method that returns projects temp upload dir name.
	 *
	 * @return string
	 */
	public static function getTempUploadDir(): string
	{
		return "esforms-tmp";
	}

	/**
	 * Method that returns projects setting name prefix.
	 *
	 * @return string
	 */
	public static function getSettingNamePrefix(): string
	{
		return "es-forms";
	}

	/**
	 * Filter settings is debug active key.
	 */
	public const FILTER_SETTINGS_IS_DEBUG_ACTIVE = 'es_forms_settings_is_debug_active';
	public const SETTINGS_DEBUG_DEVELOPER_MODE_KEY = 'developer-mode';
	public const SETTINGS_DEBUG_QM_LOG = 'skip-qm-log';
	public const SETTINGS_DEBUG_FORCE_DISABLED_FIELDS = 'skip-force-disabled-fields';

	/**
	 * Setting local type name.
	 *
	 * @var string
	 */
	public const SETTINGS_TYPE_NAME = 'settings';

	/**
	 * Setting global type name.
	 *
	 * @var string
	 */
	public const SETTINGS_GLOBAL_TYPE_NAME = 'settingsGlobal';


	public const SLUG_POST_TYPE = 'eightshift-forms';
	public const SLUG_ADMIN = 'es-forms';
	public const SLUG_ADMIN_SETTINGS = 'es-settings';
	public const SLUG_ADMIN_SETTINGS_GLOBAL = 'es-settings-global';
	public const SLUG_ADMIN_DASHBOARD = 'dashboard';

	public const FILTER_SETTINGS_WPML_IS_VALID_NAME = 'es_forms_settings_is_valid_wpml';

	/**
	 * Dynamic name route prefix for integrations items inner.
	 *
	 * @var string
	 */
	public const ROUTE_PREFIX_INTEGRATION_ITEMS_INNER = 'integration-items-inner';

	/**
	 * Dynamic name route prefix for integrations items.
	 *
	 * @var string
	 */
	public const ROUTE_PREFIX_INTEGRATION_ITEMS = 'integration-items';

	/**
	 * Dynamic name route prefix for form submit.
	 *
	 * @var string
	 */
	public const ROUTE_PREFIX_FORM_SUBMIT = 'submit';

	/**
	 * Dynamic name route prefix for integration editor.
	 *
	 * @var string
	 */
	public const ROUTE_PREFIX_INTEGRATION_EDITOR = 'integration-editor';

	
	public const CAP_LISTING = 'eightshift_forms_adminu_menu';
	public const CAP_SETTINGS = 'eightshift_forms_form_settings';
	public const CAP_SETTINGS_GLOBAL = 'eightshift_forms_global_settings';
	public const CAP_FORM = 'eightshift_forms';
	public const CAP_FORM_EDIT = 'edit_eightshift_forms';
	public const CAP_FORM_READ = 'read_eightshift_forms';
	public const CAP_FORM_DELETE = 'delete_eightshift_forms';
	public const CAP_FORM_EDIT_MULTIPLE = 'edit_eightshift_formss';
	public const CAP_FORM_EDIT_OTHERS = 'edit_others_eightshift_formss';
	public const CAP_FORM_DELETE_MULTIPLE = 'delete_eightshift_formss';
	public const CAP_FORM_PUBLISH = 'publish_eightshift_formss';
	public const CAP_FORM_READ_PRIVATE = 'read_private_eightshift_formss';
}
