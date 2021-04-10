<?php


namespace App\Domain\Interfaces\Entity;


use App\Domain\Values\Output;

interface CommunicationsInterface
{
    const INSTRUCTIONS = ['F', 'R', 'L', 'E', 'C', 'H'];
    const EXIT_INSTRUCTION = 'E';
    const OUTPUT_MESSAGE = "I'm in the (%s:%s,%s) coordinate.";
    const ERROR_OUTPUT_MESSAGE = "There has been a communication failure. Please reboot the rover systems and try again, Commander.";

    public function enterInstructions(array $instructions): void;
    public function getOutput(): Output;
    public function setOutput(Output $output): void;
    public function getTable(): array;
}
