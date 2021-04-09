<?php


namespace App\Values;


use App\DTO\Rover;
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

        $this->isEmpty = $this->isEmpty($value);
        $this->isInArray = $this->isInArray($value);
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

    private function isEmpty(string $value): bool
    {
        return $value == '';
    }

    private function isInArray(string $value): bool
    {
        return in_array($value, Rover::COMPASS);
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
