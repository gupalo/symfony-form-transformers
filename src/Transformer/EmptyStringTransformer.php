<?php

namespace Gupalo\SymfonyFormTransformers\Transformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * @implements DataTransformerInterface<string, string>
 */
class EmptyStringTransformer implements DataTransformerInterface
{
    public function transform(mixed $value): string
    {
        return $value ?? '';
    }

    public function reverseTransform(mixed $value): string
    {
        return $value ?? '';
    }
}
