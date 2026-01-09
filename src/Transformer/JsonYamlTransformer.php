<?php

namespace Gupalo\SymfonyFormTransformers\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Yaml\Yaml;

/**
 * @implements DataTransformerInterface<array<mixed>, string>
 */
class JsonYamlTransformer implements DataTransformerInterface
{
    /**
     * @param int $inline The level where you switch to inline YAML
     * @param int $indent The amount of spaces to use for indentation of nested nodes
     * @param int $flags A bit field of DUMP_* constants to customize the dumped YAML string
     */
    public function __construct(
        public int $inline = 2,
        public int $indent = 4,
        public int $flags = 0,
    )
    {
    }

    /**
     * @param array $value
     * @return string
     * @throws TransformationFailedException when the transformation fails
     */
    public function transform($value): string
    {
        try {
            $result = Yaml::dump($value, $this->inline, $this->indent, $this->flags);
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
