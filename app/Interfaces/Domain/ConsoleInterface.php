<?php


namespace App\Interfaces\Domain;


use App\Values\Output;

interface ConsoleInterface
{
    public function enterInstructions(array $instructions): void;
    public function getOutput(): Output;
    public function setOutput(Output $output): void;
}
