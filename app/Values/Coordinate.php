<?php


namespace App\Values;

use App\Interfaces\Values\ValuesInterface;

class Coordinate implements ValuesInterface
{
    private int $value;
    private bool $isNull;
    private bool $isInt;
    private bool $inRange;
    private bool $coordinateIsCorrect;

    public function __construct(int $value)
    {
        $this->coordinateIsCorrect = false;

        $this->isNull = $this->isNull($value);

        $this->isInt = $this->isInt($value);

        $this->inRange = $this->isInRange($value);

        if (!$this->isNull && $this->isInt && $this->inRange){
            $this->value = $value;
            $this->coordinateIsCorrect = true;
        }

    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function isReady(): bool
    {
        return $this->coordinateIsCorrect;
    }

    private function isNull($value): bool
    {
        return is_null($value);
    }

    private function isInt($value): bool
    {
        return is_int($value);
    }

    private function isInRange($value): bool
    {
        return !($value < 0 || $value > 200);
    }

    public function __toString(): string
    {
        return $this->getValue();
    }


}
