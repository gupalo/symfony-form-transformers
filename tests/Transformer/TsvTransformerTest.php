<?php

namespace Gupalo\SymfonyFormTransformers\Tests\Transformer;

use Gupalo\SymfonyFormTransformers\Helper\TsvHelper;
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

    public function testTransformMultiline(): void
    {
        $transformer = new TsvTransformer();

        $items = [
            ['name' => 'Paul', 'age' => '23', 'address' => '"111"5'."\n".'W Franklin', 'test' => 'test1'],
            ['name' => 'Bessy the Cow', 'age' => '5', 'address' => 'Big Farm Way', 'test' => 'test2'],
        ];
        $expected = <<<EOD
        name~age~address~test
        Paul~23~"""111""5
        W Franklin"~test1
        Bessy the Cow~5~Big Farm Way~test2
        EOD;
        TsvHelper::$multiline = true;
        $expected = str_replace('~', "\t", $expected);

        $s = $transformer->transform($items);
        self::assertSame($expected, $s);
        self::assertSame($items, $transformer->reverseTransform($s));
    }
}
