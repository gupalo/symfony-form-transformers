<?php

namespace Gupalo\SymfonyFormTransformers\Tests\Transformer;

use Gupalo\SymfonyFormTransformers\Transformer\StringArrayTransformer;
use PHPUnit\Framework\TestCase;

class StringArrayTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $transformer = new StringArrayTransformer();

        $string = <<<EOD
        uid1,uid2,
        uid3

        uid4

        5,5
        EOD;

        $normalizedString = 'uid1,uid2,uid3,uid4,5,5';

        $items = ['uid1', 'uid2', 'uid3', 'uid4', '5', '5'];

        $array = $transformer->reverseTransform($string);
        self::assertSame($items, $array);
        self::assertSame($normalizedString, $transformer->transform($array));
    }
}
