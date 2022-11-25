<?php

namespace Gupalo\SymfonyFormTransformers\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringArrayTransformer implements DataTransformerInterface
{
    /**
     * @param array $value
     * @return string
     * @throws TransformationFailedException when the transformation fails
     */
    public function transform($value): string
    {
        return implode(',', $value);
    }

    /**
     * @param string $value
     * @return array
     * @throws TransformationFailedException when the transformation fails
     */
    public function reverseTransform($value): array
    {
        $result = explode("\n", str_replace(',', "\n", $value));
        $result = array_values(array_filter(array_map('trim', $result), static fn(string $s) => $s !== ''));

        return $result;
    }
}
