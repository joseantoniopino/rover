<?php


namespace App\DTO;

use App\Values\Coordinate;
use App\Values\CardinalPoint;

final class Rover extends Engine
{
    const COMPASS = ['N', 'S', 'E', 'W'];
    const INSTRUCTIONS = ['F', 'R', 'L', 'EXIT', 'CLEAR'];
    const EXIT_INSTRUCTION = 'EXIT';

    public function __construct(
        private Coordinate $xPosition,
        private Coordinate $yPosition,
        private CardinalPoint $facing,
        private bool $canContinue = true
    )
    {}

    protected function getXPosition(): Coordinate
    {
        return $this->xPosition;
    }

    public function canContinue(): bool
    {
        return $this->canContinue;
    }

    public function setCanContinue(bool $bool): void
    {
        $this->canContinue = $bool;
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
