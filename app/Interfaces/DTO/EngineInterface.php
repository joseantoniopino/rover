<?php

namespace App\Interfaces\DTO;

interface EngineInterface
{
    public function enterInstructions(array $instructions): string;
    public function canContinue(): bool;
    public function setCanContinue(bool $bool): void;
}
