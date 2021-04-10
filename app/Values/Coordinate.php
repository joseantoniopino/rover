<?php


namespace App\Values;

use App\Domain\Rover;
use App\Interfaces\Values\ValuesInterface;

class Coordinate implements ValuesInterface
{
    private int $value;
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

    public function getValue(): int|string
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
