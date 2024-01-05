<?php

/**
 * Interface that holds all methods for building global form settings form.
 *
 * @package EightshiftFormsUtils\Settings
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Settings;

/**
 * Interface for UtilsSettingGlobalInterface
 */
interface UtilsSettingGlobalInterface
{
	/**
	 * Get global settings array for building settings page.
	 *
	 * @return array<int, array<mixed>>
	 */
	public function getSettingsGlobalData(): array;
}
