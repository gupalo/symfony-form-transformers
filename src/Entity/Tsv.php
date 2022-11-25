<?php

namespace Gupalo\SymfonyFormTransformers\Entity;

use Gupalo\SymfonyFormTransformers\Helper\TsvHelper;

class Tsv
{
    private string $tsv;

    public function getTsv(): string
    {
        return $this->tsv ?? '';
    }

    public function setTsv(?string $tsv): self
    {
        $this->tsv = $tsv ?? '';

        return $this;
    }

    public function toArray(): array
    {
        return TsvHelper::toArray($this->tsv);
    }
}
