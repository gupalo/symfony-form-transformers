<?php

namespace Gupalo\SymfonyFormTransformers\Tests\Helper;

use Gupalo\SymfonyFormTransformers\Helper\TsvHelper;
use PHPUnit\Framework\TestCase;

class TsvHelperTest extends TestCase
{
    public function testTsvToArray(): void
    {
        $tsvString = "\xEF\xBB\xBFName~Age~Address
Paul~23~1115 W Franklin
Bessy the Cow~5~Big Farm Way
Not~Full Row

";
        $tsvString = str_replace('~', "\t", $tsvString);

        $result = TsvHelper::toArray($tsvString);

        $expected = [
            ['name' => 'Paul', 'age' => '23', 'address' => '1115 W Franklin'],
            ['name' => 'Bessy the Cow', 'age' => '5', 'address' => 'Big Farm Way'],
            ['name' => 'Not', 'age' => 'Full Row', 'address' => null],
        ];
        self::assertSame($expected, $result);
    }

    public function testArrayToTsv(): void
    {
        $items = [
            ['name' => 'Paul', 'age' => '23', 'address' => '1115 W Franklin'],
            ['name' => 'Bessy the Cow', 'age' => '5', 'address' => 'Big Farm Way'],
            ['name' => 'Not', 'age' => 'Full Row', 'address' => null],
        ];
        $expected = "name~age~address
Paul~23~1115 W Franklin
Bessy the Cow~5~Big Farm Way
Not~Full Row~";
        $expected = str_replace('~', "\t", $expected);

        $s = TsvHelper::toString($items);
        self::assertSame($expected, $s);
        self::assertSame($items, TsvHelper::toArray($s));
    }
}
