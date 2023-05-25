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
            ["key" => 5, "value" => "Skimbleshanks"],
            ["key" => 7, "value" => "Mungojerrie"],
            ["key" => 9, "value" => "Rumpelteazer"],
        ];

        $expected = array_column($array, "value", "key");
        $actual = entity_column($array, "value", "key");

        $this->assertEquals($expected, $actual);
    }

    public function testCompareArrayListWithArrayColumn(): void
    {
        $array = [
            ["key" => 5, "value" => "Skimbleshanks"],
            ["key" => 7, "value" => "Mungojerrie"],
            ["key" => 9, "value" => "Rumpelteazer"],
        ];

        $expected = array_column($array, "value");
        $actual = entity_column($array, "value");

        $this->assertEquals($expected, $actual);
    }

    public function testCompareObjectWithArrayColumn(): void
    {
        $Skimbleshanks = new stdClass();
        $Skimbleshanks->key = 5;
        $Skimbleshanks->value = "Skimbleshanks";
        $Mungojerrie = new stdClass();
        $Mungojerrie->key = 7;
        $Mungojerrie->value = "Mungojerrie";
        $Rumpelteazer = new stdClass();
        $Rumpelteazer->key = 9;
        $Rumpelteazer->value = "Mungojerrie";
        $array = [$Skimbleshanks, $Mungojerrie, $Rumpelteazer];

        $expected = array_column($array, "value", "key");
        $actual = entity_column($array, "value", "key");

        $this->assertEquals($expected, $actual);
    }

    public function testCompareObjectListWithArrayColumn(): void
    {
        $Skimbleshanks = new stdClass();
        $Skimbleshanks->key = 5;
        $Skimbleshanks->value = "Skimbleshanks";
        $Mungojerrie = new stdClass();
        $Mungojerrie->key = 7;
        $Mungojerrie->value = "Mungojerrie";
        $Rumpelteazer = new stdClass();
        $Rumpelteazer->key = 9;
        $Rumpelteazer->value = "Mungojerrie";
        $array = [$Skimbleshanks, $Mungojerrie, $Rumpelteazer];

        $expected = array_column($array, "value");
        $actual = entity_column($array, "value");

        $this->assertEquals($expected, $actual);
    }

    public function testObjectWithGetters(): void
    {
        $expected = [5 => "Skimbleshanks", 7 => "Mungojerrie", 9 => "Rumpelteazer"];
        $class = new class() {
            private ?int $key;
            private ?string $value;

            public function __construct(int $key = null, string $value = null)
            {
                $this->key = $key;
                $this->value = $value;
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
        $array = [new $class(5, "Skimbleshanks"), new $class(7, "Mungojerrie"), new $class(9, "Rumpelteazer")];

        $actual = entity_column($array, "value", "key");

        $this->assertEquals($expected, $actual);
    }

    public function testObjectListWithGetters(): void
    {
        $expected = ["Skimbleshanks", "Mungojerrie", "Rumpelteazer"];
        $class = new class() {
            private ?int $key;
            private ?string $value;

            public function __construct(int $key = null, string $value = null)
            {
                $this->key = $key;
                $this->value = $value;
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
        $array = [new $class(5, "Skimbleshanks"), new $class(7, "Mungojerrie"), new $class(9, "Rumpelteazer")];

        $actual = entity_column($array, "value");

        $this->assertEquals($expected, $actual);
    }
}
