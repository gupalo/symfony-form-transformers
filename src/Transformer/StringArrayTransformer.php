<?php

namespace Gupalo\SymfonyFormTransformers\Transformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * @implements DataTransformerInterface<list<string>, string>
 */
class StringArrayTransformer implements DataTransformerInterface
{
    public function __construct(
        public string $separator = ','
    )
    {
    }

    /**
     * @param list<string> $value
     */
    public function transform(mixed $value): string
    {
        return implode($this->separator, $value);
    }

    /**
     * @return list<string>
     */
    public function reverseTransform(mixed $value): array
    {
        $result = explode("\n", str_replace($this->separator, "\n", $value));
        $result = array_values(array_filter(array_map('trim', $result), static fn(string $s) => $s !== ''));

        return $result;
    }
}
