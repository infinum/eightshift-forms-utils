<?php

/**
 * Class that holds all i18n helpers.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

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
		$output = '';

		$filterName = UtilsHooksHelper::getFilterName(['general', 'locale']);
		if (\has_filter($filterName)) {
			$locale = \apply_filters($filterName, []);

			$defaultLanguage = $locale['default'] ?? '';
			$currentLanguage = $locale['current'] ?? '';

			return $defaultLanguage === $currentLanguage ? '' : $currentLanguage;
		}

		return $output;
	}
}
