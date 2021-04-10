<?php


namespace App\Domain;

use App\Interfaces\Domain\EngineInterface;
use App\Values\CardinalPoint;
use App\Values\Coordinate;
use App\Values\Output;

abstract class Engine implements EngineInterface
{

    public function enterInstructions(array $instructions): void
    {
        foreach ($instructions as $instruction) {
            if ($this->canContinue()){
                $this->setOutput(
                    match ($instruction) {
                        'R', 'L' => $this->pivot($instruction),
                        'F' => $this->move(),
                        'E' => $this->bye(),
                        'C' => $this->clear(),
                        'H' => $this->helpMessage()
                    }
                );
            }
        }
    }

    protected function helpMessage(): Output
    {
        $message =  ' - Enter orders separated by commas. For example: F,R,F,L,L' . PHP_EOL;
        $message .= ' - Coordinates information is displayed in the following format (facing: X,Y).' . PHP_EOL;
        $message .= ' - Facing East(E) and West(W) advances or decreases the X coordinate respectively.' . PHP_EOL;
        $message .= ' - Facing North(N) and South(S) advances or decreases the Y coordinate respectively.' . PHP_EOL;
        $message .= '#---------------------------------------------------------------------------------------#' . PHP_EOL;
        $message .= ' F => FRONT: Advances the rover in the direction it is facing.' . PHP_EOL;
        $message .= ' R => RIGHT: Pivots the rover to the right. The rover will not move from its coordinates.' . PHP_EOL;
        $message .= ' L => LEFT: Pivots the rover to the left. The rover will not move from its coordinates.' . PHP_EOL;
        $message .= ' E => EXIT: Closes the connection with the rover.' . PHP_EOL;
        $message .= ' C => CLEAR: Clear the terminal and finish the current instructions sequence.' . PHP_EOL;
        $message .= ' H => HELP: Displays this help message and finish the current instructions sequence.' . PHP_EOL;
        $message .= '#---------------------------------------------------------------------------------------#' . PHP_EOL;
        $message .= $this->prepareOutput(" - ");
        $this->setCanContinue(false);
        $this->clearNoMessage();
        return new Output($message);
    }

    protected function pivot(string $instruction): Output
    {
        $direction = match ($instruction) {
            'R' => 'Right',
            'L' => 'Left',
        };

        if ($instruction == 'R') {
            match ($this->getFacing()->getValue()) {
                'N' => $this->setFacing(new CardinalPoint('E')),
                'S' => $this->setFacing(new CardinalPoint('W')),
                'E' => $this->setFacing(new CardinalPoint('S')),
                'W' => $this->setFacing(new CardinalPoint('N')),
            };
        }

        if ($instruction == 'L') {
            match ($this->getFacing()->getValue()) {
                'N' => $this->setFacing(new CardinalPoint('W')),
                'S' => $this->setFacing(new CardinalPoint('E')),
                'W' => $this->setFacing(new CardinalPoint('S')),
                'E' => $this->setFacing(new CardinalPoint('N')),
            };
        }
        $message = sprintf("Pivoting to the '%s'. ", $direction);
        $this->clearNoMessage();
        return $this->prepareOutput($message);
    }

    protected function move(): Output
    {
        $movementPerformed = false;

        if ($this->getFacing() == 'E') {
            $newPosition = $this->getXPosition()->getValue() + 1;

            if ($this->checkNextPosition($newPosition)) {
                $this->setXPosition(new Coordinate($newPosition));
                $movementPerformed = true;
            }
        }

        if ($this->getFacing() == 'W') {
            $newPosition = $this->getXPosition()->getValue() - 1;

            if ($this->checkNextPosition($newPosition)) {
                $this->setXPosition(new Coordinate($newPosition));
                $movementPerformed = true;
            }
        }

        if ($this->getFacing() == 'S') {
            $newPosition = $this->getYPosition()->getValue() - 1;

            if ($this->checkNextPosition($newPosition)) {
                $this->setYPosition(new Coordinate($newPosition));
                $movementPerformed = true;
            }
        }

        if ($this->getFacing() == 'N') {
            $newPosition = $this->getYPosition()->getValue() + 1;

            if ($this->checkNextPosition($newPosition)) {
                $this->setYPosition(new Coordinate($newPosition));
                $movementPerformed = true;
            }
        }

        if ($movementPerformed) {
            $message = "";
        } else {
            $message = "I couldn't move at new position. ";
            $this->setCanContinue(false);
        }
        $this->clearNoMessage();
        return $this->prepareOutput($message);
    }

    protected function bye(): Output
    {
        $this->setCanContinue(false);
        $this->clearNoMessage();
        return $this->prepareOutput("Bye bye, commander. ");
    }

    protected function checkNextPosition(int $newPosition): bool
    {
        return $newPosition <= 200 && $newPosition >= 0;
    }

    private function clear(): string
    {
        $this->clearNoMessage();
        $this->setCanContinue(false);

        return $this->prepareOutput("The rover console has been cleaned. ");
    }

    private function clearNoMessage(): void
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            system('cls');
        } else {
            system('clear');
        }
    }

    private function prepareOutput(string $string): Output
    {
        return new Output(sprintf($string . self::OUTPUT_MESSAGE,
            $this->getFacing(),
            $this->getXPosition(),
            $this->getYposition(),
        ));
    }
}
