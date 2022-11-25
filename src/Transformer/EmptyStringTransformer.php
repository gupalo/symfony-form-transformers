<?php

namespace Gupalo\SymfonyFormTransformers\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EmptyStringTransformer implements DataTransformerInterface
{
    /**
     * @param string $value
     * @return string
     * @throws TransformationFailedException when the transformation fails
     */
    public function transform($value): string
    {
        return $value ?? '';
    }

    /**
     * @param string $value
     * @return string
     * @throws TransformationFailedException when the transformation fails
     */
    public function reverseTransform($value): string
    {
        return $value ?? '';
    }
}
