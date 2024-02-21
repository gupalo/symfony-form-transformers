<?php

namespace Gupalo\SymfonyFormTransformers\Tests\Transformer;

use Gupalo\SymfonyFormTransformers\Transformer\JsonYamlTransformer;
use PHPUnit\Framework\TestCase;

class JsonYamlTransformerTest extends TestCase
{

    public function testTransform(): void
    {
        $transformer = new JsonYamlTransformer();

        $yaml = <<<EOD
        -
            name: Paul
            age: 23
        -
            name: 'Bessy the Cow'
            age: '5'
        -
            name: Not
            age: null
        EOD;

        $items = [
            ['name' => 'Paul', 'age' => 23],
            ['name' => 'Bessy the Cow', 'age' => '5'],
            ['name' => 'Not', 'age' => null],
        ];

        $a = $transformer->reverseTransform($yaml);
        self::assertSame($items, $a);
        self::assertSame(trim($yaml), trim($transformer->transform($a)));
    }

    public function testTransformCustomOptions(): void
    {
        $transformer = new JsonYamlTransformer(1);

        $yaml = <<<EOD
        - { name: Paul, age: 23 }
        - { name: 'Bessy the Cow', age: '5' }
        - { name: Not, age: null }
        EOD;

        $items = [
            ['name' => 'Paul', 'age' => 23],
            ['name' => 'Bessy the Cow', 'age' => '5'],
            ['name' => 'Not', 'age' => null],
        ];

        $a = $transformer->reverseTransform($yaml);
        self::assertSame($items, $a);
        self::assertSame(trim($yaml), trim($transformer->transform($a)));
    }
}
