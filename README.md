###### Bootstrapping

The project is dockerized and everything will be launched with a couple of commands, which are prepared in the Makefile.

`make build`

`make start`

###### Execute
For run command you need enter at container-be. For this other make command has created.

`make ssh-be`

Now you can run `art rover:star` in the console. "art" is an alias of "php artisan".

When the script starts the program is going to ask three parameters, **facing**, **X** and **Y**.
This is necessary to place the rover on the planet.
When you finish answering all the questions you can use the H command to see the help.

---
Enter orders separated by commas. For example: F,R,F,L,L
  
Coordinates information is displayed in the following format (facing: X,Y).
  
Facing East(E) and West(W) advances or decreases the X coordinate respectively.
  
Facing North(N) and South(S) advances or decreases the Y coordinate respectively.

---
F => FRONT: Advances the rover in the direction it is facing.

R => RIGHT: Pivots the rover to the right. The rover will not move from its coordinates.

L => LEFT: Pivots the rover to the left. The rover will not move from its coordinates.

E => EXIT: Closes the connection with the rover and show a log/table with last positions.

C => CLEAR: Clear the terminal and finish the current instructions sequence.

H => HELP: Displays this help message and finish the current instructions sequence.

T => HELP: Displays log/table of last positions


