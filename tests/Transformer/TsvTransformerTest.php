<?php

namespace Gupalo\SymfonyFormTransformers\Tests\Transformer;

use Gupalo\SymfonyFormTransformers\Transformer\TsvTransformer;
use PHPUnit\Framework\TestCase;

class TsvTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $transformer = new TsvTransformer();

        $items = [
            ['name' => 'Paul', 'age' => '23', 'address' => '1115 W Franklin'],
            ['name' => 'Bessy the Cow', 'age' => '5', 'address' => 'Big Farm Way'],
            ['name' => 'Not', 'age' => 'Full Row', 'address' => null],
        ];
        $expected = <<<EOD
        name~age~address
        Paul~23~1115 W Franklin
        Bessy the Cow~5~Big Farm Way
        Not~Full Row~
        EOD;
        $expected = str_replace('~', "\t", $expected);

        $s = $transformer->transform($items);
        self::assertSame($expected, $s);
        self::assertSame($items, $transformer->reverseTransform($s));
    }
}
