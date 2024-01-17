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
	 * Main plugin slug name.
	 *
	 * @var string
	 */
	public const MAIN_PLUGIN_PROJECT_SLUG = 'eightshift-forms';

	/**
	 * Main plugin file name.
	 *
	 * @var string
	 */
	public const MAIN_PLUGIN_FILE_NAME = 'eightshift-forms.php';

	/**
	 * Main plugin folder name.
	 *
	 * @var string
	 */
	public const MAIN_PLUGIN_FOLDER_NAME = self::MAIN_PLUGIN_PROJECT_SLUG;

	/**
	 * Main plugin full name.
	 *
	 * @var string
	 */
	public const MAIN_PLUGIN_FULL_NAME = self::MAIN_PLUGIN_FOLDER_NAME . \DIRECTORY_SEPARATOR . self::MAIN_PLUGIN_FILE_NAME;

	// ------------------------------------------------------------------
	// FILTERS
	// ------------------------------------------------------------------

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
	 * Filter name for settings builder.
	 *
	 * @var string
	 */
	public const FILTER_SETTINGS_DATA = self::FILTER_PREFIX . '_settings_data';

	/**
	 * Filter name for public filters.
	 *
	 * @var string
	 */
	public const FILTER_PUBLIC_FILTERS_DATA = self::FILTER_PREFIX . '_public_filters_data';

	/**
	 * Filter name for public actions.
	 *
	 * @var string
	 */
	public const FILTER_PUBLIC_ACTIONS_DATA = self::FILTER_PREFIX . '_public_actions_data';

	/**
	 * Filter name for fields that are not translatable.
	 *
	 * @var string
	 */
	public const FILTER_SETTINGS_NONE_TRANSLATABLE_NAMES = self::FILTER_PREFIX . '_settings_none_translatable_names';

	// ------------------------------------------------------------------
	// BLOCKS
	// ------------------------------------------------------------------

	/**
	 * Block main category slug
	 *
	 * @var string
	 */
	public const BLOCKS_MAIN_CATEGORY_SLUG = 'eightshift-forms';

	/**
	 * Block add-ons category slug
	 *
	 * @var string
	 */
	public const BLOCKS_ADDONS_CATEGORY_SLUG = 'eightshift-forms-addons';

	// ------------------------------------------------------------------
	// INTEGRATIONS
	// ------------------------------------------------------------------

	/**
	 * Integration type - default.
	 *
	 * @var string
	 */
	public const INTEGRATION_TYPE_DEFAULT = 'default';

	/**
	 * Integration type - no builder.
	 *
	 * @var string
	 */
	public const INTEGRATION_TYPE_NO_BUILDER = 'no-builder';

	/**
	 * Integration type - complex.
	 *
	 * @var string
	 */
	public const INTEGRATION_TYPE_COMPLEX = 'complex';

	// ------------------------------------------------------------------
	// FILE UPLOAD
	// ------------------------------------------------------------------

	/**
	 * File upload temp folder name.
	 *
	 * @var string
	 */
	public const TEMP_UPLOAD_DIR = 'esforms-tmp';

	/**
	 * File upload type name used for admin.
	 *
	 * @var string
	 */
	public const FILE_UPLOAD_ADMIN_TYPE_NAME = 'fileUploadAdmin';

	// ------------------------------------------------------------------
	// WP-CLI
	// ------------------------------------------------------------------

	/**
	 * Main plugin WP-CLI command prefix.
	 *
	 * @var string
	 */
	public const MAIN_PLUGIN_WP_CLI_COMMAND_PREFIX = self::MAIN_PLUGIN_PROJECT_SLUG;

	// ------------------------------------------------------------------
	// Enqueue
	// ------------------------------------------------------------------

	/**
	 * Main plugin enqueue assets prefix.
	 *
	 * @var string
	 */
	public const MAIN_PLUGIN_ENQUEUE_ASSETS_PREFIX = self::MAIN_PLUGIN_PROJECT_SLUG;

	// ------------------------------------------------------------------
	// Manifest
	// ------------------------------------------------------------------

	/**
	 * Main plugin manifest item hook name.
	 *
	 * @var string
	 */
	public const MAIN_PLUGIN_MANIFEST_ITEM_HOOK_NAME = 'es-forms-manifest-item';

	// ------------------------------------------------------------------
	// DEVELOPER
	// ------------------------------------------------------------------

	/**
	 * Debug filter is debug active key.
	 *
	 * @var string
	 */
	public const FILTER_SETTINGS_IS_DEBUG_ACTIVE = 'es_forms_settings_is_debug_active';

	/**
	 * Debug settings name - debug mode.
	 *
	 * @var string
	 */
	public const SETTINGS_DEBUG_DEBUGGING_KEY = 'troubleshooting-debugging';

	/**
	 * Debug settings name - skip validation mode.
	 *
	 * @var string
	 */
	public const SETTINGS_DEBUG_SKIP_VALIDATION_KEY = 'skip-validation';

	/**
	 * Debug settings name - skip form reset mode.
	 *
	 * @var string
	 */
	public const SETTINGS_DEBUG_SKIP_RESET_KEY = 'skip-reset';

	/**
	 * Debug settings name - skip captcha mode.
	 *
	 * @var string
	 */
	public const SETTINGS_DEBUG_SKIP_CAPTCHA_KEY = 'skip-captcha';

	/**
	 * Debug settings name - skip forms sync mode.
	 *
	 * @var string
	 */
	public const SETTINGS_DEBUG_SKIP_FORMS_SYNC_KEY = 'skip-forms-sync';

	/**
	 * Debug settings name - skip cache mode.
	 *
	 * @var string
	 */
	public const SETTINGS_DEBUG_SKIP_CACHE_KEY = 'skip-cache';

	/**
	 * Debug settings name - developer mode.
	 *
	 * @var string
	 */
	public const SETTINGS_DEBUG_DEVELOPER_MODE_KEY = 'developer-mode';

	/**
	 * Debug settings name - skip Query Monitor plugin log mode.
	 *
	 * @var string
	 */
	public const SETTINGS_DEBUG_QM_LOG = 'skip-qm-log';

	/**
	 * Debug settings name - skip force disabled fields mode.
	 *
	 * @var string
	 */
	public const SETTINGS_DEBUG_FORCE_DISABLED_FIELDS = 'skip-force-disabled-fields';

	// ------------------------------------------------------------------
	// SETTINGS TYPES
	// ------------------------------------------------------------------

	/**
	 * Settings name prefix.
	 *
	 * @var string
	 */
	public const SETTINGS_NAME_PREFIX = 'es-forms';

	/**
	 * Setting type name.
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

	/**
	 * Settings internal types - general.
	 *
	 * @var string
	 */
	public const SETTINGS_INTERNAL_TYPE_GENERAL = 'sidebar-general';

	/**
	 * Settings internal types - integration.
	 *
	 * @var string
	 */
	public const SETTINGS_INTERNAL_TYPE_INTEGRATION = 'sidebar-integration';

	/**
	 * Settings internal types - troubleshooting.
	 *
	 * @var string
	 */
	public const SETTINGS_INTERNAL_TYPE_TROUBLESHOOTING = 'sidebar-troubleshooting';

	/**
	 * Settings internal types - miscellaneous.
	 *
	 * @var string
	 */
	public const SETTINGS_INTERNAL_TYPE_MISCELLANEOUS = 'sidebar-miscellaneous';

	/**
	 * Settings internal types - advanced.
	 *
	 * @var string
	 */
	public const SETTINGS_INTERNAL_TYPE_ADVANCED = 'sidebar-advanced';

	/**
	 * Settings internal types - addon.
	 *
	 * @var string
	 */
	public const SETTINGS_INTERNAL_TYPE_ADDON = 'sidebar-addon';

	// ------------------------------------------------------------------
	// POST TYPE AND SLUG
	// ------------------------------------------------------------------

	/**
	 * Post type name.
	 *
	 * @var string
	 */
	public const SLUG_POST_TYPE = self::MAIN_PLUGIN_PROJECT_SLUG;

	/**
	 * Slug name for admin prefix.
	 *
	 * @var string
	 */
	public const SLUG_ADMIN = 'es-forms';

	/**
	 * Slug page name for settings page.
	 *
	 * @var string
	 */
	public const SLUG_ADMIN_SETTINGS = 'es-settings';

	/**
	 * Slug page name for settings global page.
	 *
	 * @var string
	 */
	public const SLUG_ADMIN_SETTINGS_GLOBAL = 'es-settings-global';

	/**
	 * Slug page name for global settings dashboard page.
	 *
	 * @var string
	 */
	public const SLUG_ADMIN_DASHBOARD = 'dashboard';

	// ------------------------------------------------------------------
	// REST API
	// ------------------------------------------------------------------

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

	/**
	 * Routes namespace.
	 *
	 * @var string
	 */
	public const ROUTE_NAMESPACE = 'eightshift-forms';

	/**
	 * Routes version number.
	 *
	 * @var string
	 */
	public const ROUTE_VERSION = 'v1';

	public const API_RESPONSE_CODE_SUCCESS = 200;
	public const API_RESPONSE_CODE_SUCCESS_RANGE = 299;
	public const API_RESPONSE_CODE_ERROR = 400;
	public const API_RESPONSE_CODE_ERROR_MISSING = 404;
	public const API_RESPONSE_CODE_ERROR_SERVER = 500;
	public const API_RESPONSE_CODE_ERROR_FORBIDDEN = 403;

	// ------------------------------------------------------------------
	// Form details keys
	// ------------------------------------------------------------------

	public const FD_DIRECT_IMPORT = 'directImport';
	public const FD_ITEM_ID = 'itemId';
	public const FD_INNER_ID = 'innerId';
	public const FD_TYPE = 'type';
	public const FD_INTEGRATION_TYPE = 'integrationType';
	public const FD_FORM_ID = 'formId';
	public const FD_POST_ID = 'postId';
	public const FD_PARAMS = 'params';
	public const FD_PARAMS_RAW = 'paramsRaw';
	public const FD_FILES = 'files';
	public const FD_SETTINGS_TYPE = 'settingsType';
	public const FD_FIELDS_ONLY = 'fieldsOnly';
	public const FD_FILES_UPLOAD = 'filesUpload';
	public const FD_ACTION = 'action';
	public const FD_ACTION_EXTERNAL = 'actionExternal';
	public const FD_API_STEPS = 'apiSteps';
	public const FD_CAPTCHA = 'captcha';
	public const FD_STORAGE = 'storage';
	public const FD_EMAIL_RESPONSE_TAGS = 'emailResponseTags';
	public const FD_IS_VALID = 'isValid';
	public const FD_IS_API_VALID = 'isApiValid';
	public const FD_LABEL = 'label';
	public const FD_ICON = 'icon';
	public const FD_FIELDS = 'fields';
	public const FD_FIELD_NAMES = 'fieldNames';
	public const FD_FIELD_NAMES_TAGS = 'fieldNamesTags';
	public const FD_FIELD_NAMES_FULL = 'fieldNamesFull';
	public const FD_STEPS_SETUP = 'stepsSetup';
	public const FD_RESPONSE_OUTPUT_DATA = 'responseOutputData';
	public const FD_ADDON = 'addon';
	public const FD_SUCCESS_REDIRECT = 'successRedirect';
	public const FD_VALIDATION = 'validation';


	// ------------------------------------------------------------------
	// Integration API response details data Keys
	// ------------------------------------------------------------------

	public const IARD_TYPE = self::FD_TYPE;
	public const IARD_STATUS = 'status';
	public const IARD_MSG = 'message';
	public const IARD_PARAMS = self::FD_PARAMS;
	public const IARD_FILES = self::FD_FILES;
	public const IARD_RESPONSE = 'response';
	public const IARD_CODE = 'code';
	public const IARD_BODY = 'body';
	public const IARD_URL = 'url';
	public const IARD_ITEM_ID = self::FD_ITEM_ID;
	public const IARD_FORM_ID = self::FD_FORM_ID;
	public const IARD_IS_DISABLED = 'isDisabled';

	// ------------------------------------------------------------------
	// CAPS
	// ------------------------------------------------------------------

	/**
	 * Cap for listing page.
	 *
	 * @var string
	 */
	public const CAP_LISTING = 'eightshift_forms_adminu_menu';

	/**
	 * Cap for settings page.
	 *
	 * @var string
	 */
	public const CAP_SETTINGS = 'eightshift_forms_form_settings';

	/**
	 * Cap for global settings page.
	 *
	 * @var string
	 */
	public const CAP_SETTINGS_GLOBAL = 'eightshift_forms_global_settings';

	/**
	 * Caps for block editor page.
	 *
	 * @var string
	 */
	public const CAP_FORM = 'eightshift_forms';
	public const CAP_FORM_EDIT = 'edit_eightshift_forms';
	public const CAP_FORM_READ = 'read_eightshift_forms';
	public const CAP_FORM_DELETE = 'delete_eightshift_forms';
	public const CAP_FORM_EDIT_MULTIPLE = 'edit_eightshift_formss';
	public const CAP_FORM_EDIT_OTHERS = 'edit_others_eightshift_formss';
	public const CAP_FORM_DELETE_MULTIPLE = 'delete_eightshift_formss';
	public const CAP_FORM_PUBLISH = 'publish_eightshift_formss';
	public const CAP_FORM_READ_PRIVATE = 'read_private_eightshift_formss';

	/**
	 * Capability list.
	 *
	 * @var array<string>
	 */
	public const CAPS = [
		self::CAP_LISTING,
		self::CAP_SETTINGS,
		self::CAP_SETTINGS_GLOBAL,
		self::CAP_FORM,
		self::CAP_FORM_EDIT,
		self::CAP_FORM_READ,
		self::CAP_FORM_DELETE,
		self::CAP_FORM_EDIT_MULTIPLE,
		self::CAP_FORM_EDIT_OTHERS,
		self::CAP_FORM_DELETE_MULTIPLE,
		self::CAP_FORM_PUBLISH,
		self::CAP_FORM_READ_PRIVATE,
	];
}
