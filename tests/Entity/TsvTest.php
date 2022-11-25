<?php

namespace Gupalo\SymfonyFormTransformers\Tests\Entity;

use Gupalo\SymfonyFormTransformers\Entity\Tsv;
use PHPUnit\Framework\TestCase;

class TsvTest extends TestCase
{
    public function testTsv(): void
    {
        $items = [
            ['name' => 'Paul', 'age' => '23', 'address' => '1115 W Franklin'],
            ['name' => 'Bessy the Cow', 'age' => '5', 'address' => 'Big Farm Way'],
            ['name' => 'Not', 'age' => 'Full Row', 'address' => null],
        ];
        $itemsTsvString = <<<EOD
        name~age~address
        Paul~23~1115 W Franklin
        Bessy the Cow~5~Big Farm Way
        Not~Full Row~
        EOD;
        $itemsTsvString = str_replace('~', "\t", $itemsTsvString);

        $tsv = (new Tsv())->setTsv($itemsTsvString);

        self::assertSame($itemsTsvString, $tsv->getTsv());
        self::assertSame($items, $tsv->toArray());
    }
}
