<?php

/**
 * Interface that holds all methods for building single form settings form.
 *
 * @package EightshiftFormsUtils\Settings
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Settings;

/**
 * Interface for UtilsSettingInterface
 */
interface UtilsSettingInterface
{
	/**
	 * Get Form settings data array
	 *
	 * @param string $formId Form Id.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getSettingsData(string $formId): array;
}
