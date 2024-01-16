<?php

/**
 * Class that holds all Integration helpers.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

use EightshiftFormsUtils\Config\UtilsConfig;

/**
 * Class UtilsIntegrationsHelper
 */
final class UtilsIntegrationsHelper
{
	/**
	 * Get all active integration on specific form.
	 *
	 * @param string $id Form Id.
	 *
	 * @return array<string, string>
	 */
	public static function getIntegrationDetailsById(string $id): array
	{
		$formDataReference = UtilsGeneralHelper::getFormDetailsById($id);

		if (!$formDataReference) {
			return [];
		}

		$type = $formDataReference[UtilsConfig::FDR_TYPE];
		$useFilter = \apply_filters(UtilsConfig::FILTER_SETTINGS_DATA, [])[$type]['use'] ?? '';

		return [
			'label' => $formDataReference[UtilsConfig::FDR_LABEL],
			'icon' => $formDataReference[UtilsConfig::FDR_ICON],
			'value' => $type,
			'isActive' => $useFilter ? UtilsSettingsHelper::isOptionCheckboxChecked($useFilter, $useFilter) : false,
			'isValid' => $formDataReference[UtilsConfig::FDR_IS_VALID],
			'isApiValid' => $formDataReference[UtilsConfig::FDR_IS_API_VALID],
		];
	}

	/**
	 * Get list of all active integrations
	 *
	 * @return array<int, string>
	 */
	public static function getActiveIntegrations(): array
	{
		$output = [];

		foreach (\apply_filters(UtilsConfig::FILTER_SETTINGS_DATA, []) as $key => $value) {
			$useFilter = $value['use'] ?? '';

			if (!$useFilter) {
				continue;
			}

			$type = $value['type'] ?? '';

			if ($type !== UtilsConfig::SETTINGS_INTERNAL_TYPE_INTEGRATION) {
				continue;
			}

			$isUsed = UtilsSettingsHelper::isOptionCheckboxChecked($useFilter, $useFilter);

			if (!$isUsed) {
				continue;
			}

			$output[] = $key;
		}

		return $output;
	}
}
