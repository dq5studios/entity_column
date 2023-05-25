<?php

declare(strict_types=1);

namespace DQ5Studios\EntityColumn;

use Symfony\Component\PropertyAccess\Exception\AccessException;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;
use Symfony\Component\PropertyAccess\Exception\NoSuchIndexException;
use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;
use Symfony\Component\PropertyAccess\Exception\UnexpectedTypeException;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * A version of array_column that can handle objects with getters.
 *
 * @param array       $array      Input
 * @param string      $column_key Property to use as the value
 * @param string|null $index_key  Property to use as the key
 *
 * @return array Key-value array
 *
 * @throws NoSuchPropertyException
 * @throws UnexpectedTypeException
 * @throws NoSuchIndexException
 * @throws AccessException
 * @throws InvalidArgumentException
 */
function entity_column(
    array $array,
    string $column_key,
    string $index_key = null
): array {
    $output = [];
    $accessor = PropertyAccess::createPropertyAccessor();

    foreach ($array as $row) {
        $value = $accessor->getValue($row, $column_key);
        if (null !== $index_key) {
            $key = $accessor->getValue($row, $index_key);
            $output[$key] = $value;
        } else {
            $output[] = $value;
        }
    }

    return $output;
}
