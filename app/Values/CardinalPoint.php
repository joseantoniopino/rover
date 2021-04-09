<?php


namespace App\Values;


use App\Domain\Rover;
use App\Interfaces\Values\ValuesInterface;

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
        return $this->value;
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
