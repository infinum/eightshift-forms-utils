<?php

/**
 * The media upload helper specific functionality.
 *
 * @package EightshiftFormsUtils\Helpers
 */

declare(strict_types=1);

namespace EightshiftFormsUtils\Helpers;

use EightshiftFormsUtils\Config\Config;

/**
 * Trait UploadHelper
 */
trait UploadHelper
{
	/**
	 * Detect if there is and error in the file upload.
	 *
	 * @param string $error String value, can be file path or error key.
	 *
	 * @return boolean
	 */
	protected function isUploadError(string $error): bool
	{
		$errors = [
			// uploadFile() method errors.
			'errorFileUploadNoFileProvided' => '',
			'errorFileUploadNoNameProvided' => '',
			'errorFileUploadNoIdProvided' => '',
			'errorFileUploadFolderUploadPathMissing' => '',
			'errorFileUploadUnableToCreateFolder' => '',
			'errorFileUploadFailtyFile' => '',
			'errorFileUploadUnableToMoveFile' => '',

			// getFilePath() method errors.
			'errorFilePathMissingUploadFolder' => '',
			'errorFilePathMissingFile' => '',

			// getUploadFolerPath() method errors.
			'errorUploadFolderPathMissingWpContentDir' => '',
		];

		return isset($errors[$error]);
	}

	/**
	 * Prepare all files and upload to uploads folder.
	 *
	 * @param array<string, mixed> $file File to prepare.
	 *
	 * @return array<string, array<int, array<string, mixed>>>
	 */
	protected function uploadFile(array $file): array
	{
		$output = $file;

		if (!$file) {
			return \array_merge(
				$output,
				[
					'errorOutput' => 'errorFileUploadNoFileProvided',
				]
			);
		}

		$fieldName = $file['fieldName'] ?? '';

		if (!$fieldName) {
			return \array_merge(
				$output,
				[
					'errorOutput' => 'errorFileUploadNoNameProvided',
				]
			);
		}

		$fileId = $file['id'] ?? '';

		if (!$fileId) {
			return \array_merge(
				$output,
				[
					'errorOutput' => 'errorFileUploadNoIdProvided',
				]
			);
		}

		$folderPath = $this->getUploadFolerPath();
		if ($this->isUploadError($folderPath)) {
			return \array_merge(
				$output,
				[
					'errorOutput' => 'errorFileUploadFolderUploadPathMissing',
				]
			);
		}

		if (!\is_dir($folderPath)) {
			$newFolder = \mkdir($folderPath);

			if (!$newFolder) {
				return \array_merge(
					$output,
					[
						'errorOutput' => 'errorFileUploadUnableToCreateFolder',
					]
				);
			}
		}

		$error = $file['error'] ?? '';

		// If file is faulty return error.
		if ($error !== \UPLOAD_ERR_OK) {
			return \array_merge(
				$output,
				[
					'errorOutput' => 'errorFileUploadFailtyFile',
				]
			);
		}

		// Create hashed file name so there is no collision.
		$ext = \explode('.', $file['name']);
		$ext = \end($ext);
		$name = "{$fileId}.{$ext}";

		// Create final folder location path.
		$finalFilePath = "{$folderPath}{$name}";

		// Move the file to new location.
		$move = \move_uploaded_file($file['tmp_name'], $finalFilePath);
		if (!$move) {
			return \array_merge(
				$output,
				[
					'errorOutput' => 'errorFileUploadUnableToMoveFile',
				]
			);
		}

		return \array_merge(
			$output,
			[
				'path' => $finalFilePath,
				'ext' => $ext,
				'errorOutput' => '',
			]
		);
	}

	/**
	 * Delete files from the uploads folder.
	 *
	 * @param array<string, mixed> $files Delete submitted files.
	 *
	 * @return void
	 */
	protected function deleteFiles(array $files): void
	{
		if (!$files) {
			return;
		}

		foreach ($files as $items) {
			if (!$items) {
				continue;
			}

			foreach ($items as $file) {
				if (\file_exists($file['path'])) {
					\unlink($file['path']);
				}
			}
		}
	}

	/**
	 * Delete all items in the tem upload folder
	 *
	 * @param int $numberOfHours Number of hours used.
	 *
	 * @return void
	 */
	protected function deleteUploadFolderContent(int $numberOfHours = 2): void
	{
		$folderPath = $this->getUploadFolerPath();
		if ($this->isUploadError($folderPath)) {
			return;
		}

		if (!\is_dir($folderPath)) {
			return;
		}

		$files = \glob("{$folderPath}*");

		if (!$files) {
			return;
		}

		foreach ($files as $file) {
			// file is younger than x hours skip it.
			if (\time() - \filemtime($file) < $numberOfHours * \HOUR_IN_SECONDS) {
				continue;
			}

			// Remove old files.
			\unlink($file);
		}
	}

	/**
	 * Return file path by provided name with ext.
	 *
	 * @param string $name File name.
	 *
	 * @return string
	 */
	protected function getFilePath(string $name): string
	{
		$folderPath = $this->getUploadFolerPath();
		if ($this->isUploadError($folderPath)) {
			return 'errorFilePathMissingUploadFolder';
		}

		$filePath = "{$folderPath}{$name}";

		if (!\file_exists($filePath)) {
			return 'errorFilePathMissingFile';
		}

		return $filePath;
	}

	/**
	 * Return file name from path.
	 *
	 * @param string $path File path.
	 *
	 * @return string
	 */
	protected function getFileNameFromPath(string $path): string
	{
		$path = \explode(\DIRECTORY_SEPARATOR, $path);
		return \end($path);
	}

	/**
	 * Return file ext from path.
	 *
	 * @param string $path File path.
	 *
	 * @return string
	 */
	protected function getFileExtFromPath(string $path): string
	{
		$filename = $this->getFileNameFromPath($path);
		$ext = \explode('.', $filename);
		return \end($ext);
	}

	/**
	 * Check if there is a faulty file in the array.
	 *
	 * @param array<string, mixed> $files Files to check.
	 *
	 * @return boolean
	 */
	protected function isFileFaulty(array $files): bool
	{
		$isFaulty = false;

		foreach ($files as $file) {
			if ($file === 'error') {
				$isFaulty = true;
				break;
			}
		}

		return $isFaulty;
	}

	/**
	 * Get upload folder path.
	 *
	 * @return string
	 */
	private function getUploadFolerPath(): string
	{
		if (!\defined('WP_CONTENT_DIR')) {
			return 'errorUploadFolderPathMissingWpContentDir';
		}

		$sep = \DIRECTORY_SEPARATOR;
		$dir = Config::getTempUploadDir();
		return \WP_CONTENT_DIR . "{$sep}{$dir}{$sep}";
	}
}