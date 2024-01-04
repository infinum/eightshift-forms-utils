<?php

/**
 * Interface that holds all methods for building global form settings form.
 *
 * @package EightshiftFormsUtils\Settings\Settings
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Settings\Settings;

/**
 * Interface for SettingGlobalInterface
 */
interface SettingGlobalInterface
{
	/**
	 * Get global settings array for building settings page.
	 *
	 * @return array<int, array<mixed>>
	 */
	public function getSettingsGlobalData(): array;
}