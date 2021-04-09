<?php


namespace App\DTO;


use App\Interfaces\DTO\EngineInterface;
use App\Values\CardinalPoint;
use App\Values\Coordinate;

abstract class Engine implements EngineInterface
{

    public function enterInstructions(array $instructions): string
    {
        $message = '';
        foreach ($instructions as $instruction) {
            if ($this->canContinue()){
                $message = match ($instruction) {
                    'R', 'L' => $this->pivot($instruction),
                    'F' => $this->move(),
                    'EXIT' => $this->bye(),
                    'CLEAR' => $this->clear()
                };
            }
        }
        return $message;
    }

    protected function pivot(string $instruction): string
    {
        $direction = match ($instruction) {
            'R' => 'Right',
            'L' => 'Left',
        };

        if ($instruction == 'R') {
            match ($this->getFacing()->getValue()) {
                'N' => $this->setFacing(new CardinalPoint('E')),
                'E' => $this->setFacing(new CardinalPoint('S')),
                'S' => $this->setFacing(new CardinalPoint('W')),
                'W' => $this->setFacing(new CardinalPoint('N')),
            };
        }

        if ($instruction == 'L') {
            match ($this->getFacing()->getValue()) {
                'N' => $this->setFacing(new CardinalPoint('W')),
                'W' => $this->setFacing(new CardinalPoint('S')),
                'S' => $this->setFacing(new CardinalPoint('E')),
                'E' => $this->setFacing(new CardinalPoint('N')),
            };
        }

        return sprintf("Pivoting to the '%s' I'm in the '%s'x'%s' position facing '%s'",
            $direction,
            $this->getXPosition(),
            $this->getYposition(),
            $this->getFacing()
        );
    }

    protected function move(): string
    {
        $movementPerformed = false;

        if ($this->getFacing()->getValue() == 'E') {
            $newPosition = $this->getXPosition()->getValue() + 1;

            if ($this->checkNextPosition($newPosition)) {
                $this->setXPosition(new Coordinate($newPosition));
                $movementPerformed = true;
            }
        }

        if ($this->getFacing()->getValue() == 'W') {
            $newPosition = $this->getXPosition()->getValue() - 1;

            if ($this->checkNextPosition($newPosition)) {
                $this->setXPosition(new Coordinate($newPosition));
                $movementPerformed = true;
            }
        }

        if ($this->getFacing()->getValue() == 'S') {
            $newPosition = $this->getYPosition()->getValue() - 1;
            if ($this->checkNextPosition($newPosition)) {
                $this->setYPosition(new Coordinate($newPosition));
                $movementPerformed = true;
            }
        }

        if ($this->getFacing()->getValue() == 'N') {
            $newPosition = $this->getYPosition()->getValue() + 1;
            if ($this->checkNextPosition($newPosition)) {
                $this->setYPosition(new Coordinate($newPosition));
                $movementPerformed = true;
            }
        }

        if ($movementPerformed) {
            $message = sprintf("I'm in the '%s'x'%s' position facing '%s'",
                $this->getXPosition(),
                $this->getYposition(),
                $this->getFacing()
            );
        } else {
            $message = sprintf("I couldn't move at new position. I am in '%s'x'%s' position facing '%s'",
                $this->getXPosition(),
                $this->getYposition(),
                $this->getFacing()
            );
            $this->setCanContinue(false);
        }

        return $message;
    }

    protected function bye(): string
    {
        $this->setCanContinue(false);
        return "Bye bye, commander";
    }

    protected function checkNextPosition(int $newPosition): bool
    {
        return $newPosition <= 200 && $newPosition >= 0;
    }

    private function clear(): string
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            system('cls');
        } else {
            system('clear');
        }
        return sprintf("The rover console has been cleaned. I am in '%s'x'%s' position facing '%s'",
            $this->getXPosition(),
            $this->getYposition(),
            $this->getFacing()
        );
    }
}
