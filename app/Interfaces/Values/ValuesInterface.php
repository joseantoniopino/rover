<?php

namespace App\Interfaces\Values;

interface ValuesInterface
{
    public function isReady(): bool;
    public function getValue(): int|string;
    public function __toString(): string;
}
