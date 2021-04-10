<?php


namespace App\Domain\Interfaces\Entity;


interface AI_Interface
{
    const COMPASS = ['N', 'S', 'E', 'W'];

    public function canContinue(): bool;
    public function setCanContinue(bool $bool): void;
}
