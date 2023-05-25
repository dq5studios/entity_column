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
            ["key" => 1, "value" => "Skimbleshanks"],
            ["key" => 2, "value" => "Mungojerrie"],
            ["key" => 3, "value" => "Rumpelteazer"],
        ];

        $expected = array_column($array, "value", "key");
        $actual = entity_column($array, "value", "key");

        $this->assertEquals($expected, $actual);
    }

    public function testCompareArrayListWithArrayColumn(): void
    {
        $array = [
            ["key" => 1, "value" => "Skimbleshanks"],
            ["key" => 2, "value" => "Mungojerrie"],
            ["key" => 3, "value" => "Rumpelteazer"],
        ];

        $expected = array_column($array, "value");
        $actual = entity_column($array, "value");

        $this->assertEquals($expected, $actual);
    }

    public function testCompareObjectWithArrayColumn(): void
    {
        $Skimbleshanks = new stdClass();
        $Skimbleshanks->key = 1;
        $Skimbleshanks->value = "Skimbleshanks";
        $Mungojerrie = new stdClass();
        $Mungojerrie->key = 2;
        $Mungojerrie->value = "Mungojerrie";
        $Rumpelteazer = new stdClass();
        $Rumpelteazer->key = 3;
        $Rumpelteazer->value = "Mungojerrie";
        $array = [$Skimbleshanks, $Mungojerrie, $Rumpelteazer];

        $expected = array_column($array, "value", "key");
        $actual = entity_column($array, "value", "key");

        $this->assertEquals($expected, $actual);
    }

    public function testCompareObjectListWithArrayColumn(): void
    {
        $Skimbleshanks = new stdClass();
        $Skimbleshanks->key = 1;
        $Skimbleshanks->value = "Skimbleshanks";
        $Mungojerrie = new stdClass();
        $Mungojerrie->key = 2;
        $Mungojerrie->value = "Mungojerrie";
        $Rumpelteazer = new stdClass();
        $Rumpelteazer->key = 3;
        $Rumpelteazer->value = "Mungojerrie";
        $array = [$Skimbleshanks, $Mungojerrie, $Rumpelteazer];

        $expected = array_column($array, "value");
        $actual = entity_column($array, "value");

        $this->assertEquals($expected, $actual);
    }

    public function testObjectWithGetters(): void
    {
        $expected = [1 => "Skimbleshanks", 2 => "Mungojerrie", 3 => "Rumpelteazer"];
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
        $array = [new $class(1, "Skimbleshanks"), new $class(2, "Mungojerrie"), new $class(3, "Rumpelteazer")];

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
        $array = [new $class(1, "Skimbleshanks"), new $class(2, "Mungojerrie"), new $class(3, "Rumpelteazer")];

        $actual = entity_column($array, "value");

        $this->assertEquals($expected, $actual);
    }
}
