<?php

/**
 * Class that holds all utils helpers.
 *
 * @package EightshiftFormsUtils\Helpers
 *
 * @license MIT
 * Modified by Eightshift team on 08-December-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace EightshiftFormsVendor\EightshiftFormsUtils\Helpers;

use EightshiftFormsVendor\EightshiftLibs\Helpers\Helpers;

/**
 * UtilsHelper class.
 */
class UtilsHelper
{
	public static array $utilsManifest = [];
	/**
	 * Return main manifest.json file.
	 *
	 * @return array<mixed>
	 */
	public static function getUtilsManifest(): array
	{
		if (!empty(static::$utilsManifest)) {
			return static::$utilsManifest;
		}

		$sep = \DIRECTORY_SEPARATOR;
		$filePath = \dirname(__FILE__, 2) . "{$sep}manifest.json";

		static::$utilsManifest = \json_decode(\implode(' ', (array)\file($filePath)), true);
		
		return static::$utilsManifest;
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
		return self::getUtilsManifest()['icons'][Helpers::kebabToCamelCase($type)] ?? '';
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
	 * Return successRedirectUrlKeys enum values.
	 *
	 * @return array<string>
	 */
	public static function getStateSuccessRedirectUrlKeys(): array
	{
		return self::getUtilsManifest()['enums']['successRedirectUrlKeys'] ?? [];
	}

	/**
	 * Return successRedirectUrlKeys enum value by name.
	 *
	 * @param string $name Name of the enum.
	 *
	 * @return string
	 */
	public static function getStateSuccessRedirectUrlKey(string $name): string
	{
		return self::getStateSuccessRedirectUrlKeys()[$name] ?? '';
	}
}
