<?php


namespace App\Interfaces\Domain;


interface AI_Interface
{
    public function canContinue(): bool;
    public function setCanContinue(bool $bool): void;
}
