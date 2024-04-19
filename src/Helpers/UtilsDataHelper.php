<?php

/**
 * Class that holds all data helpers.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

use EightshiftLibs\Helpers\Components;

/**
 * Class UtilsDataHelper
 */
final class UtilsDataHelper
{
	/**
	 * Return files from data folder.
	 *
	 * @param string $type Folder name.
	 * @param string $file File name with ext.
	 *
	 * @return array<mixed>
	 */
	public static function getDataManifest(string $type, string $file = 'manifest.json'): array
	{
		$path = self::getDataManifestRaw($type, $file);

		if ($path) {
			return \json_decode($path, true);
		}

		return [];
	}

	/**
	 * Return files from data folder in raw format.
	 *
	 * @param string $type Folder name.
	 * @param string $file File name with ext.
	 *
	 * @return string
	 */
	public static function getDataManifestRaw(string $type, string $file = 'manifest.json'): string
	{
		$path = self::getDataManifestPath($type, $file);

		if (\file_exists($path)) {
			return \file_get_contents($path); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		}

		return '';
	}

	/**
	 * Return files full path.
	 *
	 * @param string $type Folder name.
	 * @param string $file File name with ext.
	 *
	 * @return string
	 */
	public static function getDataManifestPath(string $type, string $file = 'manifest.json'): string
	{
		$sep = \DIRECTORY_SEPARATOR;
		return Components::getProjectPaths('srcPath') . "vendor-prefixed/infinum/eightshift-forms-utils/{$sep}Data{$sep}{$type}{$sep}{$file}";
	}
}
