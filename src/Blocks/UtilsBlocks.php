<?php

/**
 * Class Blocks is the base class for Gutenberg blocks registration.
 * It provides the ability to register custom blocks using manifest.json.
 *
 * @package EightshiftFormsUtils\Blocks
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Blocks;

use EightshiftLibs\Blocks\AbstractBlocks;

/**
 * Class AbstractUtilsBaseRoute
 */
class UtilsBlocks extends AbstractBlocks
{
	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		// Register all custom blocks.
		\add_action('init', [$this, 'getBlocksDataFullRaw'], 10);
		\add_action('init', [$this, 'registerBlocks'], 11);
	}
}
