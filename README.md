[![Build Status](https://img.shields.io/github/checks-status/dq5studios/entity_column/master)](https://github.com/dq5studios/entity_column/actions)
[![codecov](https://codecov.io/gh/dq5studios/entity_column/branch/master/graph/badge.svg?token=4a2C2rnBuw)](https://codecov.io/gh/dq5studios/entity_column)
[![shepherd](https://shepherd.dev/github/dq5studios/entity_column/coverage.svg)](https://shepherd.dev/github/dq5studios/entity_column)

# entity_column

A drop-in replacement for `array_column()` that supports objects with getters.

## Usage

```php
function entity_column(array $array, string $column_key, string|null $index_key = null): array
```

### Parameters

array
> A multi-dimensional array or an array of objects from which to pull a column of values from.

column_key
> The column of values to return.

index_key
> The column to use as the index/keys for the returned array.


### Return Values

Returns an array of values representing a single column from the input array.
