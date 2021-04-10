<?php


namespace App\Values;


use App\Domain\Rover;
use App\Interfaces\Values\ValuesInterface;

class Output implements ValuesInterface
{
    private string $message;
    private bool $isEmpty;
    private bool $isCorrectMessage;
    private bool $isString;

    public function __construct(string $message)
    {
        $this->isCorrectMessage = false;
        $this->isEmpty = $message == '';
        $this->isString = is_string($message);
        if ($this->isString && !$this->isEmpty){
            $this->message = $message;
            $this->isCorrectMessage = true;
        }
    }

    public function getValue(): string
    {
        if ($this->isReady()){
            return $this->message;
        } else {
            return Rover::ERROR_OUTPUT_MESSAGE;
        }
    }

    public function isReady(): bool
    {
        return $this->isCorrectMessage;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
