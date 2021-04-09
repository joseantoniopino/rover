<?php

namespace App\Interfaces\Values;

interface ValuesInterface
{
    public function getValue(): int|string;
    public function isReady(): bool;
    public function __toString(): string;
}
