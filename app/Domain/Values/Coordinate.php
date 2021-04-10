<?php


namespace App\Domain\Values;

use App\Domain\Interfaces\Values\ValuesInterface;
use App\Domain\Rover;

class Coordinate implements ValuesInterface
{
    private string $value;
    private bool $isNull;
    private bool $isNumber;
    private bool $inRange;
    private bool $coordinateIsCorrect;

    public function __construct(string $value)
    {
        $this->coordinateIsCorrect = false;
        $this->isNull = is_null($value);
        $this->isNumber = is_numeric($value);
        $this->inRange = !($value < 0 || $value > 200);

        if (!$this->isNull && $this->isNumber && $this->inRange){
            $this->value = $value;
            $this->coordinateIsCorrect = true;
        }
    }

    public function getValue(): string
    {
        if ($this->isReady()){
            return $this->value;
        } else {
            return Rover::ERROR_OUTPUT_MESSAGE;
        }
    }

    public function isReady(): bool
    {
        return $this->coordinateIsCorrect;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
