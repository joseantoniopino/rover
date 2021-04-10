<?php


namespace App\Interfaces\Domain;


interface EngineInterface extends AI_Interface, ConsoleInterface
{
    const COMPASS = ['N', 'S', 'E', 'W'];
    const INSTRUCTIONS = ['F', 'R', 'L', 'E', 'C', 'H'];
    const EXIT_INSTRUCTION = 'E';
    const OUTPUT_MESSAGE = "I'm in the (%s:%s,%s) coordinate.";
    const ERROR_OUTPUT_MESSAGE = "There has been a communication failure. Please reboot the rover systems and try again, Commander.";
}
