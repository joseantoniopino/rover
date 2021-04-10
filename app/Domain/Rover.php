<?php


namespace App\Domain;

use App\Domain\Values\Coordinate;
use App\Domain\Values\CardinalPoint;
use App\Domain\Values\Output;

final class Rover extends Engine
{
    private int $i = 0;
    private Output $output;
    private array $table;
    private bool $canContinue;

    public function __construct(
        private Coordinate $xPosition,
        private Coordinate $yPosition,
        private CardinalPoint $facing,
    ){
        $this->setCanContinue(true);
        $this->setTable();
    }

    public function canContinue(): bool
    {
        return $this->canContinue;
    }

    public function setCanContinue(bool $bool): void
    {
        $this->canContinue = $bool;
    }

    public function getOutput(): Output
    {
        return $this->output;
    }

    public function setOutput(Output $output): void
    {
        $this->output = $output;
    }

    public function getTable(): array
    {
        return $this->table;
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

    protected function setTable(): void
    {
        $this->table[$this->i]['FACING'] = $this->getFacing();
        $this->table[$this->i]['X'] = $this->getXPosition();
        $this->table[$this->i]['Y'] = $this->getYPosition();
        $this->i++;
    }
}
