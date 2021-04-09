<?php


namespace App\Interfaces\Domain;


interface ConsoleInterface
{
    public function enterInstructions(array $instructions): void;
    public function getOutput(): string;
    public function setOutput(string $output): void;
}
