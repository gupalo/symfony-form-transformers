<?php

namespace Gupalo\SymfonyFormTransformers\Transformer;

use Gupalo\SymfonyFormTransformers\Helper\TsvHelper;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * @implements DataTransformerInterface<array<array<string, mixed>>, string>
 */
class TsvTransformer implements DataTransformerInterface
{
    public function transform(mixed $value): string
    {
        return TsvHelper::toString($value ?? []);
    }

    /**
     * @return array<array<string, mixed>>
     */
    public function reverseTransform(mixed $value): array
    {
        return TsvHelper::toArray($value ?? '');
    }
}
