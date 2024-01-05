<?php

/**
 * Class that holds all i18n helpers.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

use EightshiftFormsUtils\Config\UtilsConfig;

/**
 * Class UtilsI18nHelper
 */
final class UtilsI18nHelper
{
	/**
	 * Set locale depending on default locale or hook override.
	 *
	 * @return string
	 */
	public static function getLocale(): string
	{
		$locale = '';
		$localeInit = '';

		$filterName = Helper::getFilterName(['general', 'locale']);
		if (\has_filter($filterName)) {
			$locale = \apply_filters($filterName, $localeInit);
		}

		$useWpml = \apply_filters(UtilsConfig::FILTER_SETTINGS_WPML_IS_VALID_NAME, []);
		if ($useWpml) {
			$defaultLanguage = \apply_filters('wpml_default_language', null);
			$currentLanguage = \apply_filters('wpml_current_language', null);

			if ($defaultLanguage === $currentLanguage) {
				$locale = $localeInit;
			} else {
				$locale = $currentLanguage;
			}
		}

		return $locale;
	}
}
