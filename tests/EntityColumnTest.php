<?php

declare(strict_types=1);

namespace DQ5Studios\EntityColumn\Tests;

use PHPUnit\Framework\TestCase;
use stdClass;

use function DQ5Studios\EntityColumn\entity_column;

/**
 * @covers \DQ5Studios\EntityColumn\entity_column
 */
class EntityColumnTest extends TestCase
{
    public function testCompareArrayWithArrayColumn(): void
    {
        $array = [
            ["key" => 1, "value" => "AAA"],
            ["key" => 2, "value" => "BBB"],
            ["key" => 3, "value" => "CCC"],
        ];

        $expected = array_column($array, "value", "key");
        $actual = entity_column($array, "value", "key");

        $this->assertEquals($expected, $actual);
    }

    public function testCompareObjectWithArrayColumn(): void
    {
        $aaa = new stdClass();
        $aaa->key = 1;
        $aaa->value = "AAA";
        $bbb = new stdClass();
        $bbb->key = 2;
        $bbb->value = "BBB";
        $ccc = new stdClass();
        $ccc->key = 3;
        $ccc->value = "BBB";
        $array = [$aaa, $bbb, $ccc];

        $expected = array_column($array, "value", "key");
        $actual = entity_column($array, "value", "key");

        $this->assertEquals($expected, $actual);
    }

    public function testObjectWithGetters(): void
    {
        $expected = [1 => "AAA", 2 => "BBB", 3 => "CCC"];
        $class = new class(0, "ZZZ") {
            public function __construct(private int $key, private string $value)
            {
            }

            public function getKey(): int
            {
                return $this->key;
            }

            public function getValue(): string
            {
                return $this->value;
            }
        };
        $array = [new $class(1, "AAA"), new $class(2, "BBB"), new $class(3, "CCC")];

        $actual = entity_column($array, "value", "key");

        $this->assertEquals($expected, $actual);
    }
}
