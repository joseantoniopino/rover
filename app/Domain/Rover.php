<?php


namespace App\Domain;

use App\Values\Coordinate;
use App\Values\CardinalPoint;

final class Rover extends Engine
{

    public function __construct(
        private Coordinate $xPosition,
        private Coordinate $yPosition,
        private CardinalPoint $facing,
        private bool $canContinue = true,
        private string $output = ''
    ){}

    public function canContinue(): bool
    {
        return $this->canContinue;
    }

    public function setCanContinue(bool $bool): void
    {
        $this->canContinue = $bool;
    }

    public function getOutput(): string
    {
        return $this->output;
    }

    public function setOutput(string $output): void
    {
        $this->output = $output;
    }

    protected function getXPosition(): Coordinate
    {
        return $this->xPosition;
    }

    protected function setXPosition(Coordinate $xPosition): void
    {
        $this->xPosition = $xPosition;
    }

    protected function getYPosition(): Coordinate
    {
        return $this->yPosition;
    }

    protected function setYPosition(Coordinate $yPosition): void
    {
        $this->yPosition = $yPosition;
    }

    protected function getFacing(): CardinalPoint
    {
        return $this->facing;
    }

    protected function setFacing(CardinalPoint $facing): void
    {
        $this->facing = $facing;
    }
}
