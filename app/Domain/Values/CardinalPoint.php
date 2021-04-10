<?php


namespace App\Domain\Values;


use App\Domain\Interfaces\Values\ValuesInterface;
use App\Domain\Rover;

class CardinalPoint implements ValuesInterface
{
    private string $value;
    private bool $isCorrectCardinalPoint;
    private bool $isEmpty;
    private bool $isInArray;


    public function __construct($value)
    {
        $this->isCorrectCardinalPoint = false;
        $this->isEmpty = $value == '';
        $this->isInArray = in_array($value, Rover::COMPASS);

        if (!$this->isEmpty && $this->isInArray) {
            $this->value = $value;
            $this->isCorrectCardinalPoint = true;
        }
    }

    public function getValue(): string
    {
        if ($this->isReady()){
            return $this->value;
        } else {
            return Rover::OUTPUT_MESSAGE;
        }

    }

    public function isReady(): bool
    {
        return $this->isCorrectCardinalPoint;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
