<?php

namespace Gupalo\SymfonyFormTransformers\Transformer;

use Gupalo\SymfonyFormTransformers\Helper\TsvHelper;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TsvTransformer implements DataTransformerInterface
{
    /**
     * @param array $value
     * @return string
     * @throws TransformationFailedException when the transformation fails
     */
    public function transform($value): string
    {
        return TsvHelper::toString($value ?? []);
    }

    /**
     * @param string $value
     * @return array
     * @throws TransformationFailedException when the transformation fails
     */
    public function reverseTransform($value): array
    {
        return TsvHelper::toArray($value ?? '') ?? [];
    }
}
