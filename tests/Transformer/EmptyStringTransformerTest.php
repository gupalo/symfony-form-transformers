<?php

namespace Gupalo\SymfonyFormTransformers\Tests\Transformer;

use Gupalo\SymfonyFormTransformers\Transformer\EmptyStringTransformer;
use PHPUnit\Framework\TestCase;

class EmptyStringTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $transformer = new EmptyStringTransformer();

        self::assertSame('aaa', $transformer->transform('aaa'));
        self::assertSame('aaa', $transformer->reverseTransform('aaa'));

        self::assertSame('', $transformer->transform(null));
        self::assertSame('', $transformer->reverseTransform(null));
    }
}
