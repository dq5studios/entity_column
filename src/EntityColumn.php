<?php

declare(strict_types=1);

namespace DQ5Studios\EntityColumn;

use Symfony\Component\PropertyAccess\Exception\AccessException;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;
use Symfony\Component\PropertyAccess\Exception\NoSuchIndexException;
use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;
use Symfony\Component\PropertyAccess\Exception\UnexpectedTypeException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

use function function_exists;
use function is_array;

if (!function_exists("DQ5Studios\EntityColumn\entity_column")) {
    /**
     * A version of array_column that can handle objects with getters.
     *
     * @param array<array-key,array|object> $array      Input
     * @param int|string                    $column_key Property to use as the value
     * @param int|string|null               $index_key  Property to use as the key
     *
     * @return array Key-value array
     *
     * @throws NoSuchPropertyException
     * @throws UnexpectedTypeException
     * @throws NoSuchIndexException
     * @throws AccessException
     * @throws InvalidArgumentException
     * @throws NoSuchIndexException
     */
    function entity_column(
        array $array,
        $column_key,
        $index_key = null,
    ): array {
        $output = [];
        static $accessor = null;
        /** @var PropertyAccessor */
        $accessor ??= PropertyAccess::createPropertyAccessorBuilder()
            ->enableExceptionOnInvalidIndex()
            ->getPropertyAccessor();

        foreach ($array as $row) {
            if (is_array($row)) {
                $value = $accessor->getValue($row, "[{$column_key}]");
            } else {
                $value = $accessor->getValue($row, "{$column_key}");
            }

            if (null !== $index_key) {
                if (is_array($row)) {
                    $key = $accessor->getValue($row, "[{$index_key}]");
                } else {
                    $key = $accessor->getValue($row, "{$index_key}");
                }
                $output[$key] = $value;
            } else {
                $output[] = $value;
            }
        }

        return $output;
    }
}
