<?php

/**
 * Class Blocks is the base class for Gutenberg blocks registration.
 * It provides the ability to register custom blocks using manifest.json.
 *
 * @package EightshiftFormsUtils\Blocks
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Blocks;

use EightshiftFormsUtils\Helpers\UtilsHooksHelper;
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

		// Register all custom blocks from add-ons.
		\add_filter(UtilsHooksHelper::getFilterName(['blocks', 'allowedBlocks']), [$this, 'getAddonBlocks']);
	}

	/**
	 * Get add-on blocks list.
	 *
	 * @return array<int, string> List of blocks.
	 */
	public function getAddonBlocks(): array
	{
		return [];
	}
}
