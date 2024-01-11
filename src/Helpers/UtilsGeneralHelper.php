<?php

/**
 * Class that holds all generic helpers.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

use EightshiftFormsUtils\Config\UtilsConfig;
use EightshiftLibs\Helpers\Components;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

/**
 * UtilsGeneralHelper class.
 */
final class UtilsGeneralHelper
{
	/**
	 * Method that returns project version.
	 *
	 * Generally used for versioning asset handlers while enqueueing them.
	 *
	 * @return string
	 */
	public static function getProjectVersion(): string
	{
		if (!\function_exists('get_plugin_data')) {
			require_once(\ABSPATH . 'wp-admin/includes/plugin.php');
		}

		$details = \get_plugin_data(Components::getProjectPaths('cliOutput') . \DIRECTORY_SEPARATOR . UtilsConfig::MAIN_PLUGIN_FILE_NAME);

		return isset($details['Version']) ? (string) $details['Version'] : '1.0.0';
	}

	/**
	 * Method that returns listing page url.
	 *
	 * @return string
	 */
	public static function getListingPageUrl(): string
	{
		$page = UtilsConfig::SLUG_ADMIN;

		return \get_admin_url(null, "admin.php?page={$page}");
	}

	/**
	 * Method that returns form settings page url.
	 *
	 * @param string $formId Form ID.
	 * @param string $type Type key.
	 *
	 * @return string
	 */
	public static function getSettingsPageUrl(string $formId, string $type): string
	{
		$page = UtilsConfig::SLUG_ADMIN_SETTINGS;
		$typeKey = '';

		if (!empty($type)) {
			$typeKey = "&type={$type}";
		}

		return \get_admin_url(null, "admin.php?page={$page}&formId={$formId}{$typeKey}");
	}

	/**
	 * Method that returns form settings global page url.
	 *
	 * @param string $type Type key.
	 *
	 * @return string
	 */
	public static function getSettingsGlobalPageUrl(string $type): string
	{
		$page = UtilsConfig::SLUG_ADMIN_SETTINGS_GLOBAL;
		$typeKey = '';

		if (!empty($type)) {
			$typeKey = "&type={$type}";
		}

		return \get_admin_url(null, "admin.php?page={$page}{$typeKey}");
	}

	/**
	 * Method that returns new form page url.
	 *
	 * @return string
	 */
	public static function getNewFormPageUrl(): string
	{
		$postType = UtilsConfig::SLUG_POST_TYPE;

		return \get_admin_url(null, "post-new.php?post_type={$postType}");
	}

	/**
	 * Method that returns trash page url.
	 *
	 * @return string
	 */
	public static function getFormsTrashPageUrl(): string
	{
		return self::getListingPageUrl() . '&type=trash';
	}

	/**
	 * Method that returns entries page url.
	 *
	 * @param string $formId Form ID.
	 *
	 * @return string
	 */
	public static function getFormsEntriesPageUrl(string $formId): string
	{
		return self::getListingPageUrl() . "&type=entries&formId={$formId}";
	}

	/**
	 * Method that returns form edit page url.
	 *
	 * @param string $formId Form ID.
	 *
	 * @return string
	 */
	public static function getFormEditPageUrl(string $formId): string
	{
		return \get_edit_post_link((int) $formId) ?? '';
	}

	/**
	 * Method that checks if request is a part of the forms.
	 *
	 * @return bool
	 */
	public static function isEightshiftFormsAdminPages(): bool
	{
		$page = isset($_GET['page']) ? \sanitize_text_field(\wp_unslash($_GET['page'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		$pages = \array_flip([
			UtilsConfig::SLUG_ADMIN,
			UtilsConfig::SLUG_ADMIN_SETTINGS,
			UtilsConfig::SLUG_ADMIN_SETTINGS_GLOBAL,
		]);

		return isset($pages[$page]) && \is_admin();
	}

	/**
	 * Method that returns form trash action url.
	 *
	 * @param string $formId Form ID.
	 * @param bool $permanent Permanently delete.
	 *
	 * @return string
	 */
	public static function getFormTrashActionUrl(string $formId, bool $permanent = false): string
	{
		return (string) \get_delete_post_link((int) $formId, '', $permanent);
	}

	/**
	 * Method that returns form trash restore action url.
	 *
	 * @param string $formId Form ID.
	 *
	 * @return string
	 */
	public static function getFormTrashRestoreActionUrl(string $formId): string
	{
		return \get_admin_url(null, \wp_nonce_url("post.php?post={$formId}&action=untrash", 'untrash-post_' . $formId));
	}

	/**
	 * Check if current page is part of the settings page
	 *
	 * @return boolean
	 */
	public static function isSettingsPage(): bool
	{
		global $plugin_page; // phpcs:ignore Squiz.NamingConventions.ValidVariableName.NotCamelCaps

		return !empty($plugin_page); // phpcs:ignore Squiz.NamingConventions.ValidVariableName.NotCamelCaps
	}

	/**
	 * Minify string
	 *
	 * @param string $string String to check.
	 *
	 * @return string
	 */
	public static function minifyString(string $string): string
	{
		$string = \str_replace(\PHP_EOL, ' ', $string);
		$string = \preg_replace('/[\r\n]+/', "\n", $string);
		return (string) \preg_replace('/[ \t]+/', ' ', (string) $string);
	}


	/**
	 * Convert inner blocks to array
	 *
	 * @param string $string String to convert.
	 * @param string $type Type of content.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public static function convertInnerBlocksToArray(string $string, string $type): array
	{
		$output = [];

		switch ($type) {
			case 'select':
				$re = '/<option[^>]*value="(.*?)"[^>]*>([^<]*)<\s*\/\s*option\s*>/m';
				break;
			default:
				$re = '';
				break;
		}

		if (!$re) {
			return $output;
		}

		\preg_match_all($re, $string, $matches, \PREG_SET_ORDER, 0);

		if (!$matches) {
			return $output;
		}

		foreach ($matches as $match) {
			$output[] = [
				'label' => self::minifyString($match[2] ?? ''),
				'value' => self::minifyString($match[1] ?? ''),
				'original' => $match[0] ?? '',
			];
		}

		return $output;
	}

	/**
	 * Return block details depending on the full block name.
	 *
	 * @param string $blockName Block name.
	 *
	 * @return array<string, string>
	 */
	public static function getBlockNameDetails(string $blockName): array
	{
		$block = \explode('/', $blockName);
		$blockName = \end($block);

		return [
			'namespace' => $block[0] ?? '',
			'name' => $blockName,
			'nameAttr' => Components::kebabToCamelCase($blockName),
		];
	}

	/**
	 * Convert camel to snake case
	 *
	 * @param string $input Name to change.
	 *
	 * @return string
	 */
	public static function camelToSnakeCase($input): string
	{
		return \strtolower((string) \preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
	}

	/**
	 * Convert string from kebab to snake case.
	 *
	 * @param string $stringToConvert String to convert.
	 *
	 * @return string
	 */
	public static function kebabToSnakeCase(string $stringToConvert): string
	{
		return \str_replace('-', '_', $stringToConvert);
	}

	/**
	 * Output the form type used by checking the post_content and extracting the block used for the integration.
	 *
	 * @param string $formId Form ID to check.
	 *
	 * @return string
	 */
	public static function getFormTypeById(string $formId): string
	{
		$content = \get_post_field('post_content', (int) $formId);

		if (!$content) {
			return '';
		}

		$blocks = \parse_blocks($content);

		if (!$blocks) {
			return '';
		}

		$blockName = $blocks[0]['innerBlocks'][0]['blockName'] ?? '';

		if (!$blockName) {
			return '';
		}

		return self::getBlockNameDetails($blockName)['name'];
	}

	/**
	 * Output the form type used by checking the post_content and extracting the block used for the integration.
	 *
	 * @param string $formId Form ID to check.
	 *
	 * @return string
	 */
	public static function isFormValid(string $formId): string
	{
		$content = \get_post_field('post_content', (int) $formId);

		if (!$content) {
			return '';
		}

		$blocks = \parse_blocks($content);

		if (!$blocks) {
			return '';
		}

		$blockName = $blocks[0]['innerBlocks'][0]['blockName'] ?? '';

		if (!$blockName) {
			return '';
		}

		return self::getBlockNameDetails($blockName)['name'];
	}

	/**
	 * Get current form content from the database and do prepare output.
	 *
	 * @param string $formId Form Id.
	 *
	 * @return array<string, mixed>
	 */
	public static function getFormDetailsById(string $formId): array
	{
		$output = [
			'formId' => $formId,
			'isValid' => false,
			'isApiValid' => false,
			'label' => '',
			'icon' => '',
			'type' => '',
			'itemId' => '',
			'innerId' => '',
			'fields' => [],
			'fieldsOnly' => [],
			'fieldNames' => [],
			'fieldNamesTags' => [],
			'fieldNamesFull' => [],
			'stepsSetup' => [],
		];

		$form = \get_post_field('post_content', (int) $formId);

		if (!$form) {
			return $output;
		}

		$blocks = \parse_blocks($form); // phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps

		if (!$blocks) {
			return $output;
		}

		$blocks = $blocks[0];

		$blockName = $blocks['innerBlocks'][0]['blockName'] ?? '';

		if (!$blockName) {
			return $output;
		}

		$blockName = self::getBlockNameDetails($blockName);
		$namespace = $blockName['namespace'];
		$type = $blockName['nameAttr'];

		$fieldsOnly = $blocks['innerBlocks'][0]['innerBlocks'] ?? [];

		$settings = \apply_filters(UtilsConfig::FILTER_SETTINGS_DATA, [])[$type] ?? [];

		$output['type'] = $type;
		$output['integrationType'] = $settings['integrationType'] ?? '';
		$output['label'] = $settings['labels']['title'] ?? '';
		$output['icon'] = $settings['labels']['icon'] ?? '';
		$output['itemId'] = $blocks['innerBlocks'][0]['attrs']["{$type}IntegrationId"] ?? '';
		$output['innerId'] = $blocks['innerBlocks'][0]['attrs']["{$type}IntegrationInnerId"] ?? '';
		$output['fields'] = $blocks;
		$output['fieldsOnly'] = $fieldsOnly;

		switch ($output['integrationType']) {
			case UtilsConfig::INTEGRATION_TYPE_COMPLEX:
				if ($output['itemId'] && $output['type'] && $output['innerId']) {
					$output['isValid'] = true;

					if ($output['fieldsOnly']) {
						$output['isApiValid'] = true;
					}
				}
				break;
			case UtilsConfig::INTEGRATION_TYPE_NO_BUILDER:
				if ($output['type']) {
					$output['isValid'] = true;

					if ($output['fieldsOnly']) {
						$output['isApiValid'] = true;
					}
				}
				break;
			default:
				if ($output['itemId'] && $output['type']) {
					$output['isValid'] = true;

					if ($output['fieldsOnly']) {
						$output['isApiValid'] = true;
					}
				}
				break;
		}

		$ignoreBlocks = \array_flip([
			'step',
			'submit',
		]);

		foreach ($output['fieldsOnly'] as $item) {
			$blockItemName = self::getBlockNameDetails($item['blockName'])['nameAttr'];

			$value = $item['attrs'][Components::kebabToCamelCase("{$blockItemName}-{$blockItemName}-Name")] ?? '';

			if (!$value) {
				continue;
			}

			$output['fieldNamesFull'][] = $value;

			if (isset($ignoreBlocks[$blockItemName])) {
				continue;
			}

			$output['fieldNames'][] = $value;

			if ($blockItemName === 'file') {
				continue;
			}

			$output['fieldNamesTags'][] = $value;
		}

		// Check if this form uses steps.
		$hasSteps = \array_search($namespace . '/step', \array_column($output['fieldsOnly'], 'blockName'), true);
		$hasSteps = $hasSteps !== false;

		if ($hasSteps) {
			$stepCurrent = 'step-init';

			// If the users don't add first step add it to the list.
			if ($output['fieldsOnly'][0]['blockName'] !== "{$namespace}/step") {
				\array_unshift(
					$output['fieldsOnly'],
					[
						'blockName' => "{$namespace}/step",
						'attrs' => [
							'stepStepName' => $stepCurrent,
							'stepStepLabel' => \__('Step init', 'eightshift-forms'),
							'stepStepContent' => '',
						],
						'innerBlocks' => [],
						'innerHTML' => '',
						'innerContent' => [],
					],
				);
			}

			foreach ($output['fieldsOnly'] as $block) {
				$blockName = self::getBlockNameDetails($block['blockName']);
				$name = $blockName['name'];

				if ($name === 'step') {
					$stepCurrent = $block['attrs'][Components::kebabToCamelCase("{$name}-{$name}Name")] ?? '';
					$stepLabel = $block['attrs'][Components::kebabToCamelCase("{$name}-{$name}Label")] ?? '';

					if (!$stepLabel) {
						$stepLabel = $stepCurrent;
					}
					$output['stepsSetup']['steps'][$stepCurrent] = [
						'label' => $stepLabel,
						'value' => $stepCurrent,
					];

					continue;
				}

				if ($name === 'submit') {
					continue;
				}

				$itemName = $block['attrs'][Components::kebabToCamelCase("{$name}-{$name}Name")] ?? '';
				if (!$itemName) {
					continue;
				}

				$output['stepsSetup']['steps'][$stepCurrent]['subItems'][] = $itemName;
				$output['stepsSetup']['relations'][$itemName] = $stepCurrent;
			}

			$output['stepsSetup']['multiflow'] = $output['fields']['innerBlocks'][0]['attrs']["{$type}StepMultiflowRules"] ?? [];
		}

		return $output;
	}

	/**
	 * Convert all special characters in attributes.
	 * Logic got from the core `serialize_block_attributes` function.
	 *
	 * @param string $attribute Attribute value to check.
	 *
	 * @return string
	 */
	public static function unserializeAttributes(string $attribute): string
	{
		// It can happen that we get null here because WP that is why.
		if (\is_string($attribute)) {
			$attribute = \preg_replace('/\u002d\u002d/', '--', $attribute);
		}

		if (\is_string($attribute)) {
			$attribute = \preg_replace('/\u003c/', '<', $attribute);
		}

		if (\is_string($attribute)) {
			$attribute = \preg_replace('/\u003e/', '>', $attribute);
		}

		if (\is_string($attribute)) {
			$attribute = \preg_replace('/\u0026/', '&', $attribute);
		}

		if (\is_string($attribute)) {
			// Regex: /\\"/.
			$attribute = \preg_replace('/\u0022/', '"', $attribute);
		}

		if (!\is_string($attribute)) {
			return '';
		}

		return $attribute;
	}


	/**
	 * Find email field from params sent by form.
	 *
	 * @param array<string, mixed> $params Params to check.
	 *
	 * @return string
	 */
	public static function getEmailParamsField(array $params): string
	{
		$allowed = [
			'email' => 0,
			'e-mail' => 1,
			'mail' => 2,
			'email_address' => 3,
		];

		$field = \array_filter(
			$params,
			static function ($item) use ($allowed) {
				if (isset($allowed[$item['name'] ?? ''])) {
					return true;
				}
			}
		);

		return \reset($field)['value'] ?? '';
	}

	/**
	 * Convert date formats to libs formats.
	 *
	 * @param string $date Date to convert.
	 * @param string $separator Date separator.
	 *
	 * @return string
	 */
	public static function getCorrectLibDateFormats(string $date, string $separator): string
	{
		return \implode(
			$separator,
			\array_map(
				static function ($item) {
					$item = \count_chars($item, 3);

					if ($item === 'Y') {
						return $item;
					}

					return \strtolower($item);
				},
				\explode($separator, $date)
			)
		);
	}

	/**
	 * Prepare generic params output. Used if no specific configurations are needed.
	 *
	 * @param array<string, mixed> $params Params.
	 * @param array<string> $exclude Exclude params.
	 *
	 * @return array<string, mixed>
	 */
	public static function prepareGenericParamsOutput(array $params, array $exclude = []): array
	{
		$output = [];

		$exclude = \array_flip($exclude);

		foreach ($params as $param) {
			$value = $param['value'] ?? '';
			if (!$value) {
				continue;
			}

			$name = $param['name'] ?? '';
			if (!$name) {
				continue;
			}

			if (isset($exclude[$name])) {
				continue;
			}

			$output[$name] = $value;
		}

		return $output;
	}

	/**
	 * Return counries filtered by some key for multiple usages.
	 *
	 * @return array<int, array<int, string>>
	 */
	public static function getCountrySelectList(): array
	{
		return UtilsDataHelper::getDataManifest('country');
	}

	/**
	 * Output additional content from filter by block.
	 * Limited to front page only.
	 *
	 * @param string $name Name of the block/component.
	 * @param array<string, mixed> $attributes To load in filter.
	 *
	 * @return string
	 */
	public static function getBlockAdditionalContentViaFilter(string $name, array $attributes): string
	{
		if (\is_admin()) {
			return '';
		}

		if (self::isBlockEditor()) {
			return '';
		}

		$filterName = UtilsHooksHelper::getFilterName(['block', $name, 'additionalContent']);

		if (\has_filter($filterName)) {
			return \apply_filters($filterName, $attributes);
		}

		return '';
	}

	/**
	 * Find array value by key in recursive array.
	 *
	 * @param array<mixed> $array Array to find.
	 * @param string $needle Key name to find.
	 *
	 * @return array<int, string>
	 */
	public static function recursiveFind(array $array, string $needle): array
	{
		$iterator  = new RecursiveArrayIterator($array);
		$recursive = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
		$aHitList = [];

		foreach ($recursive as $key => $value) {
			if ($key === $needle) {
				\array_push($aHitList, $value);
			}
		}

		return $aHitList;
	}

	/**
	 * Output select options ass array from html string.
	 *
	 * @param string $options Options string.
	 *
	 * @return array<int, array<string, string>>
	 */
	public static function getSelectOptionsArrayFromString(string $options): array
	{
		$output = \wp_json_encode($options);
		$output = \str_replace('\n\t\t\t', '', $output);
		$output = \str_replace('>\n\t', '>', $output);
		$output = \str_replace('\n\t', ' ', $output);
		$output = \str_replace('\n\t', ' ', $output);
		$output = \trim(\json_decode($output));

		\preg_match_all('/<option value="(.*?)">(.*?)<\/option>/m', $output, $matches, \PREG_SET_ORDER, 0);

		return \array_values(\array_filter(\array_map(
			static function ($item) {
				$slug = $item[1] ?? '';
				$label = $item[2] ?? '';

				if (!$slug || !$label) {
					return false;
				}

				return [
					'slug' => $slug,
					'label' => $label,
				];
			},
			$matches
		)));
	}

	/**
	 * Is block editor page.
	 *
	 * @return boolean
	 */
	public static function isBlockEditor(): bool
	{
		if (!\function_exists('get_current_screen')) {
			return false;
		}

		$currentScreen = \get_current_screen() ?? '';

		if (!\method_exists($currentScreen, 'is_block_editor')) {
			return false;
		}

		return $currentScreen->is_block_editor();
	}

	/**
	 * Get current url with params.
	 *
	 * @return string
	 */
	public static function getCurrentUrl(): string
	{
		$port = isset($_SERVER['HTTPS']) ? \sanitize_text_field(\wp_unslash($_SERVER['HTTPS'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$host = isset($_SERVER['HTTP_HOST']) ? \sanitize_text_field(\wp_unslash($_SERVER['HTTP_HOST'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$request = isset($_SERVER['REQUEST_URI']) ? \sanitize_text_field(\wp_unslash($_SERVER['REQUEST_URI'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		return ($port ? "https" : "http") . "://{$host}{$request}";
	}

	/**
	 * Remove unecesery custom params.
	 *
	 * @param array<string, mixed> $params Params to check.
	 * @param array<int, string> $additional Additional keys to remove.
	 *
	 * @return array<string, mixed>
	 */
	public static function removeUneceseryParamFields(array $params, array $additional = []): array
	{
		$customFields = \array_flip(Components::flattenArray(UtilsHelper::getStateParams()));
		$additional = \array_flip($additional);

		return \array_filter(
			$params,
			static function ($item) use ($customFields, $additional) {
				if (isset($customFields[$item['name'] ?? ''])) {
					return false;
				}

				if ($additional && isset($additional[$item['name'] ?? ''])) {
					return false;
				}

				return true;
			}
		);
	}

	/**
	 * Check if integration can use sync feature.
	 *
	 * @param string $integrationName Integration name.
	 *
	 * @return boolean
	 */
	public static function canIntegrationUseSync(string $integrationName): bool
	{
		return isset(\apply_filters(UtilsConfig::FILTER_SETTINGS_DATA, [])[$integrationName]['fields']);
	}

	/**
	 * Clean url from query params.
	 *
	 * @param string $url Url to clean.
	 *
	 * @return string
	 */
	public static function cleanPageUrl(string $url): string
	{
		return \preg_replace('/\\?.*/', '', $url);
	}

	/**
	 * Set and output data to output log using Query Monitor plugin.
	 *
	 * @param mixed $data Data to output.
	 *
	 * @return void
	 */
	public static function setQmLogsOutput($data = ''): void
	{
		if (\is_plugin_active('query-monitor/query-monitor.php') && UtilsDeveloperHelper::isDeveloperQMLogActive() && $data) {
			\do_action('qm/debug', $data); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
		}
	}

	/**
	 * Return all posts where form is assigned.
	 *
	 * @param string $formId Form Id.
	 *
	 * @return array<int, mixed>
	 */
	public static function getBlockLocations(string $formId): array
	{
		global $wpdb;

		$items = $wpdb->get_results( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
			$wpdb->prepare(
				"SELECT ID, post_type, post_title, post_status
				 FROM $wpdb->posts
				 WHERE post_content
				 LIKE %s
				 AND (post_status='publish' OR post_status='draft')
				",
				"%\"formsFormPostId\":\"{$formId}\"%"
			)
		);

		if (!$items) {
			return [];
		}

		$isDeveloperModeActive = UtilsDeveloperHelper::isDeveloperModeActive();

		return \array_map(
			function ($item) use ($isDeveloperModeActive) {
				$id = $item->ID;
				$title = $item->post_title; // phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
				$title = $isDeveloperModeActive ? "{$id} - {$title}" : $title;

				return [
					'id' => $id,
					'postType' => $item->post_type, // phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
					'title' => $title,
					'status' => $item->post_status, // phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
					'editLink' => self::getFormEditPageUrl((string) $id),
					'viewLink' => \get_permalink($id),
					'activeIntegration' => [
						'isActive' => true,
						'isValid' => true,
						'isApiValid' => true,
					]
				];
			},
			$items
		);
	}

	/**
	 * Get the settings labels and details by type and key.
	 * This method is used to provide the ability to translate all strings.
	 *
	 * @param string $type Settings type from the Settings class.
	 *
	 * @return array<string, string>
	 */
	public static function getSpecialConstants(string $type): array
	{
		$data = [
			'tracking' => [
				'{invalidFieldsString}' => \__('comma-separated list of invalid fields', 'eightshift-forms'),
				'{invalidFieldsArray}' => \__('array of invalid fields', 'eightshift-forms'),
			],
		];
		return isset($data[$type]) ? $data[$type] : [];
	}
}
