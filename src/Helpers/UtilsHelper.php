<?php

/**
 * Class that holds all utils helpers.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

use EightshiftLibs\Helpers\Components;

/**
 * UtilsHelper class.
 */
class UtilsHelper
{
	/**
	 * Manifest file path getter for better loading time.
	 *
	 * @var array<mixed>
	 */
	private static $esFormsUtilsManifest = [];

	/**
	 * Return main manifest.json file.
	 *
	 * @return array<mixed>
	 */
	public static function getUtilsManifest(): array
	{
		if (!empty(self::$esFormsUtilsManifest)) {
			return self::$esFormsUtilsManifest;
		}

		$sep = \DIRECTORY_SEPARATOR;
		$filePath = \dirname(__FILE__, 2) . "{$sep}manifest.json";

		$file = \file_get_contents($filePath); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

		if (!$file) {
			return [];
		}

		self::$esFormsUtilsManifest = \json_decode($file, true);

		return self::$esFormsUtilsManifest;
	}

	/**
	 * Return utils icons from manifest.json.
	 *
	 * @param string $type Type to return.
	 *
	 * @return string
	 */
	public static function getUtilsIcons(string $type): string
	{
		return self::getUtilsManifest()['icons'][Components::kebabToCamelCase($type)] ?? '';
	}

	/**
	 * Return selector admin enum value by name.
	 *
	 * @param string $name Name of the enum.
	 *
	 * @return string
	 */
	public static function getStateSelectorAdmin(string $name): string
	{
		return self::getUtilsManifest()['enums']['selectorsAdmin'][$name] ?? '';
	}

	/**
	 * Return selector enum value by name.
	 *
	 * @param string $name Name of the enum.
	 *
	 * @return string
	 */
	public static function getStateSelector(string $name): string
	{
		return self::getUtilsManifest()['enums']['selectors'][$name] ?? '';
	}

	/**
	 * Return attribute enum value by name.
	 *
	 * @param string $name Name of the enum.
	 *
	 * @return string
	 */
	public static function getStateAttribute(string $name): string
	{
		return self::getUtilsManifest()['enums']['attrs'][$name] ?? '';
	}

	/**
	 * Return all params enum values.
	 *
	 * @return array<string>
	 */
	public static function getStateParams(): array
	{
		return self::getUtilsManifest()['enums']['params'] ?? [];
	}

	/**
	 * Return param enum value by name.
	 *
	 * @param string $name Name of the enum.
	 *
	 * @return string
	 */
	public static function getStateParam(string $name): string
	{
		return self::getStateParams()[$name] ?? '';
	}

	/**
	 * Return all responseOutputKeys enum values.
	 *
	 * @return array<string>
	 */
	public static function getStateResponseOutputKeys(): array
	{
		return self::getUtilsManifest()['enums']['responseOutputKeys'] ?? [];
	}

	/**
	 * Return responseOutputKeys enum value by name.
	 *
	 * @param string $name Name of the enum.
	 *
	 * @return string
	 */
	public static function getStateResponseOutputKey(string $name): string
	{
		return self::getStateResponseOutputKeys()[$name] ?? '';
	}

	/**
	 * Return successRedirectUrlKeys enum value by name.
	 *
	 * @param string $name Name of the enum.
	 *
	 * @return string
	 */
	public static function getStateSuccessRedirectUrlKeys(string $name): string
	{
		return self::getUtilsManifest()['enums']['successRedirectUrlKeys'][$name] ?? '';
	}
}
