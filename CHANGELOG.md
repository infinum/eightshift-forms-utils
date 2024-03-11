
# Change Log for the Eightshift Forms Utils library
All notable changes to this project will be documented in this file.

This projects adheres to [Semantic Versioning](https://semver.org/) and [Keep a CHANGELOG](https://keepachangelog.com/).

## [1.3.0]

### Added
- new constants for CPT result.

### Changed
- `getListingPageUrl` function is now more dynamic.

### Removed
- `getFormsLocationsPageUrl` function.
- `getFormsEntriesPageUrl` function.
- `getFormsTrashPageUrl` function.

## [1.2.4]

### Removed
- `FD_PARAMS_SKIPPED` due to not being used.

## [1.2.3]

### Added
- new `FD_PARAMS_SKIPPED` constant for skipped params.

## [1.2.2]

### Added
- `skippedParams` enum param for setting skipped params on multistep forms.

## [1.2.1]

### Added
- `getFormsLocationsPageUrl` function.

## [1.2.0]

### Removed
- `unserializeAttributes` function as it's not used anymore.

## [1.1.10]

### Added
- new `FD_ENTRY_ID` constant for entry id.

### Removed
- `processCommonSubmitActionFormData` function.
- `getIntegrationApiPublicOutput` function.

## [1.1.9]

### Changed
- `getIntegrationApiPublicOutput` now supports callback param instead of calling entries action.

## [1.1.8]

### Added
- One new admin selectors.

## [1.1.7]

### Added
- Three new admin selectors.

## [1.1.6]

### Changed
- Typo

## [1.1.5]

### Added
- New function `getFieldDetailsByName` that will extract field details from the form data params.

## [1.1.4]

### Changed
- Location of the data manifest path.

## [1.1.3]

### Added
- `getPartialFormFieldNames` function can now accept a custom wrapper for output.

## [1.1.2]

### Added
- New selector variable for step debug preview.

## [1.1.1]

### Added
- New selector variable for debug preview.

## [1.1.0]

### Changed
- The way we generate and load forms public filters from filter call to global variable.

## [1.0.0]

- Initial production release.

[1.3.0]: https://github.com/infinum/eightshift-forms-utils/compare/1.2.4...1.3.0
[1.2.4]: https://github.com/infinum/eightshift-forms-utils/compare/1.2.3...1.2.4
[1.2.3]: https://github.com/infinum/eightshift-forms-utils/compare/1.2.2...1.2.3
[1.2.2]: https://github.com/infinum/eightshift-forms-utils/compare/1.2.1...1.2.2
[1.2.1]: https://github.com/infinum/eightshift-forms-utils/compare/1.2.0...1.2.1
[1.2.0]: https://github.com/infinum/eightshift-forms-utils/compare/1.1.10...1.2.0
[1.1.10]: https://github.com/infinum/eightshift-forms-utils/compare/1.1.9...1.1.10
[1.1.9]: https://github.com/infinum/eightshift-forms-utils/compare/1.1.8...1.1.9
[1.1.8]: https://github.com/infinum/eightshift-forms-utils/compare/1.1.7...1.1.8
[1.1.7]: https://github.com/infinum/eightshift-forms-utils/compare/1.1.6...1.1.7
[1.1.6]: https://github.com/infinum/eightshift-forms-utils/compare/1.1.5...1.1.6
[1.1.5]: https://github.com/infinum/eightshift-forms-utils/compare/1.1.4...1.1.5
[1.1.4]: https://github.com/infinum/eightshift-forms-utils/compare/1.1.3...1.1.4
[1.1.3]: https://github.com/infinum/eightshift-forms-utils/compare/1.1.2...1.1.3
[1.1.2]: https://github.com/infinum/eightshift-forms-utils/compare/1.1.1...1.1.2
[1.1.1]: https://github.com/infinum/eightshift-forms-utils/compare/1.1.0...1.1.1
[1.1.0]: https://github.com/infinum/eightshift-forms-utils/compare/1.0.0...1.1.0
[1.0.0]: https://github.com/infinum/eightshift-forms-utils/releases/tag/1.0.0
