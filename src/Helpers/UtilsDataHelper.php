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
	 * Manifest file path getter for better loading time.
	 *
	 * @var array<mixed>
	 */
	private static $esFormsUtilsDataManifests = [];

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
		if (isset(self::$esFormsUtilsDataManifests[$type]) && !empty(self::$esFormsUtilsDataManifests[$type])) {
			return self::$esFormsUtilsDataManifests[$type];
		}

		$filePath = self::getDataManifestPath($type, $file);

		if (!\file_exists($filePath)) {
			return [];
		}

		$file = \file_get_contents($filePath); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

		if (!$file) {
			return [];
		}

		self::$esFormsUtilsDataManifests[$type] = \json_decode($file, true);

		return self::$esFormsUtilsDataManifests[$type];
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
		return Components::getProjectPaths('srcPath') . "vendor-prefixed/infinum/eightshift-forms-utils{$sep}src{$sep}Data{$sep}{$type}{$sep}{$file}";
	}
}
