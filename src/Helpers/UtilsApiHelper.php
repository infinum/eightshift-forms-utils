<?php

/**
 * Class that holds all api helpers used in classes.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

use EightshiftFormsUtils\Config\UtilsConfig;
use EightshiftLibs\Helpers\Components;

/**
 * UtilsApiHelper class.
 */
final class UtilsApiHelper
{
	/**
	 * Return API response array details.
	 *
	 * @param array<mixed> $response Response got from the API.
	 *
	 * @return array<string, mixed>
	 */
	/**
	 * Return API response array details.
	 *
	 * @param string $integration Integration name from settings.
	 * @param mixed $response API full reponse.
	 * @param string $url Url of the request.
	 * @param array<mixed> $params All params prepared for API.
	 * @param array<mixed> $files All files prepared for API.
	 * @param string $itemId List Id used for API (questions, form id, list id, item id).
	 * @param string $formId Internal form ID.
	 * @param boolean $isDisabled If integration is disabled.
	 * @param boolean $isCurl Used for some changed if native cURL is used.
	 *
	 * @return array<string, mixed>
	 */
	public static function getIntegrationApiReponseDetails(
		string $integration,
		$response,
		string $url,
		array $params = [],
		array $files = [],
		string $itemId = '',
		string $formId = '',
		bool $isDisabled = false,
		bool $isCurl = false
	): array {

		// Do regular stuff if this is not and WP_Error.
		if (!\is_wp_error($response)) {
			if ($isCurl) {
				$code = $response['status'] ?? UtilsConfig::API_RESPONSE_CODE_SUCCESS;
				$body = $response;
			} else {
				$code = $response['response']['code'] ?? UtilsConfig::API_RESPONSE_CODE_SUCCESS;
				$body = $response['body'] ?? '';

				if (Components::isJson($body)) {
					$body = \json_decode($body, true) ?? [];
				}
			}
		} else {
			// Mock response for WP_Error.
			$code = UtilsConfig::API_RESPONSE_CODE_ERROR;
			$body = [
				'error' => $response->get_error_message(),
			];
			$response = [];
		}

		return [
			UtilsConfig::IARD_TYPE => $integration,
			UtilsConfig::IARD_PARAMS => $params,
			UtilsConfig::IARD_FILES => $files,
			UtilsConfig::IARD_RESPONSE => $response['response'] ?? [],
			UtilsConfig::IARD_CODE => $code,
			UtilsConfig::IARD_BODY => !\is_string($body) ? $body : [],
			UtilsConfig::IARD_URL => $url,
			UtilsConfig::IARD_ITEM_ID => $itemId,
			UtilsConfig::IARD_FORM_ID => $formId,
			UtilsConfig::IARD_IS_DISABLED => $isDisabled,
		];
	}

	/**
	 * Return Integration API error response array - in combination with getIntegrationApiReponseDetails response.
	 *
	 * NOTE: Not for public response on API.
	 *
	 * @param array<string, mixed> $details Details provided by getIntegrationApiReponseDetails method.
	 * @param array<string, mixed> $additional Additional array details to attach to the success output.
	 *
	 * @return array<string, mixed>
	 */
	public static function getIntegrationErrorInternalOutput(array $details, array $additional = []): array
	{
		return \array_merge(
			$details,
			[
				'status' => UtilsConfig::STATUS_ERROR,
				'message' => $details[UtilsConfig::IARD_MSG] ?? '',
			],
			$additional
		);
	}

	/**
	 * Return Integration API success response array - in combination with getIntegrationApiReponseDetails response.
	 *
	 * NOTE: Not for public response on API.
	 *
	 * @param array<string, mixed> $details Details provided by getIntegrationApiReponseDetails method.
	 * @param array<string, mixed> $additional Additional array details to attach to the success output.
	 *
	 * @return array<string, mixed>
	 */
	public static function getIntegrationSuccessInternalOutput(array $details, array $additional = []): array
	{
		$type = $details[UtilsConfig::IARD_TYPE] ?? '';

		return \array_merge(
			$details,
			[
				'status' => UtilsConfig::STATUS_SUCCESS,
				'message' => "{$type}Success",
			],
			$additional
		);
	}

	/**
	 * Return Integration API final response array depending on the status - in combination with getIntegrationApiReponseDetails response.
	 *
	 * @param array<string, mixed> $formDetails Data passed from the `getFormDetailsApi` function.
	 * @param string $msg Message to output.
	 *
	 * @return array<string, array<mixed>|int|string>
	 */
	public static function getIntegrationApiPublicOutput(array $formDetails, string $msg): array
	{
		$response = $formDetails[UtilsConfig::IARD_RESPONSE] ?? [];
		$status = $response[UtilsConfig::IARD_STATUS] ?? UtilsConfig::STATUS_ERROR;

		$additionalOutput = [];

		if (isset($formDetails[UtilsConfig::FD_SUCCESS_REDIRECT])) {
			$additionalOutput[UtilsHelper::getStateResponseOutputKey('successRedirect')] = $formDetails[UtilsConfig::FD_SUCCESS_REDIRECT];
		}

		if (isset($formDetails[UtilsConfig::FD_ADDON])) {
			$additionalOutput[UtilsHelper::getStateResponseOutputKey('addon')] = $formDetails[UtilsConfig::FD_ADDON];
		}

		if (isset($response[UtilsConfig::IARD_VALIDATION])) {
			$additionalOutput[UtilsHelper::getStateResponseOutputKey('validation')] = $response[UtilsConfig::IARD_VALIDATION];
		}

		if ($status === UtilsConfig::STATUS_SUCCESS) {
			return self::getApiSuccessPublicOutput(
				$msg,
				$additionalOutput,
				$response
			);
		}

		return self::getApiErrorPublicOutput(
			$msg,
			$additionalOutput,
			$response
		);
	}

	/**
	 * This function will take form details and apply additional data to it before it is processed.
	 * It is used in both integrations and non integrations like mailer so it can share the same functionality.
	 *
	 * @param array<string, mixed> $formDetails Data passed from the `getFormDetailsApi` function.
	 * @return array<string, mixed>
	 */
	public function processCommonSubmitActionFormData(array $formDetails): array
	{
		// Pre response filter for addon data.
		$filterName = UtilsHooksHelper::getFilterName(['block', 'form', 'preResponseAddonData']);
		if (\has_filter($filterName)) {
			$formDetails[UtilsConfig::FD_ADDON] = \apply_filters($filterName, [], $formDetails);
		}

		// Pre response filter for success redirect data.
		$filterName = UtilsHooksHelper::getFilterName(['block', 'form', 'preResponseSuccessRedirectData']);
		if (\has_filter($filterName)) {
			$formDetails[UtilsConfig::FD_SUCCESS_REDIRECT] = UtilsEncryption::encryptor(\wp_json_encode(\apply_filters($filterName, [], $formDetails)));
		}

		return $formDetails;
	}

	/**
	 * Return API error response array.
	 *
	 * @param string $msg Msg for the user.
	 * @param array<string, mixed> $additional Additonal data to attach to response.
	 * @param array<string, mixed> $debug Debug options.
	 *
	 * @return array<string, array<mixed>|int|string>
	 */
	public static function getApiErrorPublicOutput(string $msg, array $additional = [], array $debug = []): array
	{
		$output = [
			'status' => UtilsConfig::STATUS_ERROR,
			'code' => UtilsConfig::API_RESPONSE_CODE_ERROR,
			'message' => $msg,
		];

		if ($additional) {
			$output['data'] = $additional;
		}

		if (UtilsDeveloperHelper::isDeveloperModeActive() && $debug) {
			$output['debug'] = $debug;
		}

		return $output;
	}

	/**
	 * Return API success response array - Generic.
	 *
	 * @param string $msg Msg for the user.
	 * @param array<int|string, mixed> $additional Additonal data to attach to response.
	 * @param array<string, mixed> $debug Debug options.
	 *
	 * @return array<string, array<mixed>|int|string>
	 */
	public static function getApiSuccessPublicOutput(string $msg, array $additional = [], array $debug = []): array
	{
		$output = [
			'status' => UtilsConfig::STATUS_SUCCESS,
			'code' => UtilsConfig::API_RESPONSE_CODE_SUCCESS,
			'message' => $msg,
		];

		if ($additional) {
			$output['data'] = $additional;
		}

		if (UtilsDeveloperHelper::isDeveloperModeActive() && $debug) {
			$output['debug'] = $debug;
		}

		return $output;
	}

	/**
	 * Return API warning response array - Generic.
	 *
	 * @param string $msg Msg for the user.
	 * @param array<int|string, mixed> $additional Additonal data to attach to response.
	 * @param array<string, mixed> $debug Debug options.
	 *
	 * @return array<string, array<mixed>|int|string>
	 */
	public static function getApiWarningPublicOutput(string $msg, array $additional = [], array $debug = []): array
	{
		$output = [
			'status' => UtilsConfig::STATUS_WARNING,
			'code' => UtilsConfig::API_RESPONSE_CODE_SUCCESS,
			'message' => $msg,
		];

		if ($additional) {
			$output['data'] = $additional;
		}

		if (UtilsDeveloperHelper::isDeveloperModeActive() && $debug) {
			$output['debug'] = $debug;
		}

		return $output;
	}

	/**
	 * Return API error response array for missing permissions.
	 *
	 * @return array<string, mixed>
	 */
	public static function getApiPermissionsErrorPublicOutput(): array
	{
		return self::getApiErrorPublicOutput(
			\esc_html__('You don\'t have enough permissions to perform this action!', 'eightshift-forms'),
		);
	}
}
