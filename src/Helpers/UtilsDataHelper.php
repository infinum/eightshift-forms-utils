<?php

/**
 * Class that holds all data helpers.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

use EightshiftLibs\Helpers\Helpers;

/**
 * Class UtilsDataHelper
 */
final class UtilsDataHelper
{
	/**
	 * Return files full path.
	 *
	 * @param string $path Path to the file.
	 *
	 * @return string
	 */
	public static function getDataManifestPath(string $path): string
	{
		return Helpers::joinPaths([Helpers::getProjectPaths('pluginRoot'), 'vendor-prefixed', 'infinum', 'eightshift-forms-utils', 'src', 'Data', $path]);
	}
}
