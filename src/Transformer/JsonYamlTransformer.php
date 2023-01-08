<?php

namespace Gupalo\SymfonyFormTransformers\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Yaml\Yaml;

class JsonYamlTransformer implements DataTransformerInterface
{
    /**
     * @param array $value
     * @return string
     * @throws TransformationFailedException when the transformation fails
     */
    public function transform($value): string
    {
        try {
            $result = Yaml::dump($value);
        } catch (\Throwable $e) {
            throw new TransformationFailedException($e->getMessage(), previous: $e, invalidMessage: 'YAML parse error: ' . $e->getMessage());
        }

        return $result;
    }

    /**
     * @param string $value
     * @return array
     * @throws TransformationFailedException when the transformation fails
     */
    public function reverseTransform($value): array
    {
        try {
            $value = str_replace("\t", '    ', $value);

            $result = Yaml::parse($value) ?? [];
        } catch (\Throwable $e) {
            throw new TransformationFailedException($e->getMessage(), previous: $e, invalidMessage: 'YAML parse error: ' . $e->getMessage());
        }

        return $result;
    }
}
