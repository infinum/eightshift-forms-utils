<?php

/**
 * File containing an abstract class for holding Assets Manifest functionality.
 *
 * It is used to provide manifest.json file location used with Webpack to fetch correct file locations.
 *
 * @package EightshiftFormsUtils\Manifest
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Manifest;

use EightshiftLibs\Helpers\Components;
use EightshiftLibs\Manifest\AbstractManifest;

/**
 * Class UtilsManifest
 */
class UtilsManifest extends AbstractManifest
{
	/**
	 * Register all hooks. Changed filter name to manifest.
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_action('init', [$this, 'setAssetsManifestRaw']);
	}

	/**
	 * Manifest file path getter.
	 *
	 * @return string
	 */
	public function getManifestFilePath(): string
	{
		$sep = \DIRECTORY_SEPARATOR;
		return Components::getProjectPaths('cliOutput') . "{$sep}public{$sep}manifest.json";
	}
}
