<?php

namespace Gupalo\SymfonyFormTransformers\Helper;

class TsvHelper
{
    private const SEPARATOR = "\t";

    public static function toArray(string $tsv): array
    {
        $tsv = self::sanitizeString($tsv);
        $result = self::parseToArray($tsv);
        $result = self::addHeaderAsKeysToArray($result);

        return $result;
    }

    public static function toString(array $items): string
    {
        $keyKeys = [];
        foreach ($items as $item) {
            foreach (array_keys($item) as $key) {
                $keyKeys[$key] = true;
            }
        }
        $keys = array_keys($keyKeys);

        $rows = [];
        $rows[] = implode("\t", $keys);
        foreach ($items as $item) {
            $row = [];
            foreach ($keys as $key) {
                $row[$key] = (string)($item[$key] ?? '');
            }
            $rows[] = implode("\t", $row);
        }

        return implode("\n", $rows);
    }

    private static function parseToArray(string $tsv): array
    {
        $rows = explode("\n", $tsv);
        foreach ($rows as &$row) {
            $row = array_map('trim', explode(self::SEPARATOR, $row));
        }
        unset($row);

        return $rows;
    }

    private static function addHeaderAsKeysToArray(array $rows): array
    {
        $keys = array_shift($rows);
        $keys = array_map('mb_strtolower', $keys);
        $keys = array_map('trim', $keys);

        $keysCount = count($keys);
        foreach ($rows as &$row) {
            if (count($row) < $keysCount) {
                /** @noinspection OpAssignShortSyntaxInspection */
                $row = $row + array_fill(0, $keysCount, null);
            }

            $row = array_combine($keys, $row);
        }
        unset($row);

        return $rows;
    }

    private static function sanitizeString(string $tsv): string
    {
        $string = trim($tsv);
        $string = ltrim($string, "\xEF\xBB\xBF");
        $string = str_replace("\r", '', $string);

        return $string;
    }
}
