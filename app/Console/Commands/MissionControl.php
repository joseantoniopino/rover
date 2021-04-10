<?php

namespace App\Console\Commands;

use App\Domain\Rover;
use App\Domain\Values\CardinalPoint;
use App\Domain\Values\Coordinate;
use App\Domain\Values\Output;
use Illuminate\Console\Command;

class MissionControl extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rover:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Turns on the rover';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->greetings();

        // Enter coordinates
        do {

            do{
                $xPosition = new Coordinate($this->ask('Enter the X coordinate (Enter a number between 0 and 200)'));
            } while (!$xPosition->isReady());

            do{
                $yPosition = new Coordinate($this->ask('Enter the Y coordinate (Enter a number between 0 and 200)'));
            } while (!$yPosition->isReady());

            $coordinatesConfirmed = $this->confirm("Do you want to start the exploration at the $xPosition x $yPosition coordinate, Commander?");
        } while (!$coordinatesConfirmed);

        // Enter facing position
        do {
            $this->dots(3);
            $facing = new CardinalPoint($this->choice("Indicate the orientation of the vehicle", Rover::COMPASS, 'N', null, false));
            $facingConfirmed = $this->confirm("Do you want to orient the rover to the '$facing'?");
        } while(!$facingConfirmed && $facing->isReady());


        // Initialize Rover
        $message = new Output(sprintf(Rover::OUTPUT_MESSAGE, $facing, $xPosition, $yPosition));
        $rover = new Rover($xPosition, $yPosition, $facing);
        $this->info($message);

        // This loop contains the logic of the instructions that are coming to the rover
        do {
            $exit = false;

            $instructions = $this->choice('Waiting for orders commander (Press H for help)', Rover::INSTRUCTIONS, null, null, true);

            if (!$rover->canContinue())
                $rover->setCanContinue(true);

            $rover->enterInstructions($instructions);
            $this->info($rover->getOutput());

            if (in_array(Rover::EXIT_INSTRUCTION, $instructions))
                $exit = true;


        } while(!$exit);

        $this->table(
            ['FACING', 'X', 'Y'],
            $rover->getTable()
        );

        return 0;
    }

    private function greetings(): void
    {
        $this->info('Greetings commander. The rover has been started. Now we will place it in a coordinate to begin the exploration');
        $this->dots(2);
        $this->info('In this mission we are flat earthers and we explore a flat and square planet. Its dimensions are 200x200');
        $this->info('If you place the rover beyond the limits, it will crash at the end of the world.');
    }

    private function dots(int $count = 1, int $seconds = 1): void
    {
        /* $dots = '.';
         for ($i = 0; $i < $count; $i++)
         {
             $this->info($dots);
             $dots .= '.';
             sleep($seconds);
         }*/
    }
}
