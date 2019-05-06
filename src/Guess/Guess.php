<?php

namespace Fay\Guess;

/*
* Guess my number. A class supporting the game through GET, POST and SESSION.
*
*/
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */     
    private $number;
    private $tries;
 
     /**
      * Constructor to initiate the object with current game settings,
      * if available. Randomize the current number if no value is sent in.
      *
      * @param int $number The current secret number, default -1 to initiate
      *                    the number from start.
      * @param int $tries  Number of tries a guess has been made,
      *                    default 6.
      */
    public function __construct(int $number = -1, int $tries = 6)
    {
        if ($this->number == -1) {
            $this->random();
        }
        $this->number = $number;
        $this->tries = $tries;
    }
    
    // Function to randomize secret number to initiate anew game.
    public function random() : void
    {
        $this->number = rand(1, 100);
    }
 
    // Function to get number of tries left.
    public function tries() : int
    {
        return $this->tries;
    }
 
    // Function to get the secret number.
    public function number() : int
    {
        return $this->number;
    }

    /**
    * Function to make a guess, decrease the remaining guesses and return a string stating status of the guess or i no guesses remain.
    * @throws GuessException when guessed number is out of bounds.
    *
    * @return string to show the status of the guess made.
    */
    public function makeGuess(int $guess) : string
    {
        
        if (!($guess > 0 && $guess <= 100)) {
            throw new GuessException("The number must be between 1 and 100.");
        }
        $this->tries -= 1; //Count down
        if ($this->tries <= 0) { //Zero tries left. Stop game.
            $this->number = null;
            $result = "Game over.";
            session_destroy();
        } elseif ($guess > $this->number && $this->tries > 0) {
            $result = "You guessed to high.";
        } elseif ($guess < $this->number && $this->tries > 0) {
            $result = "You guessed to low.";
        } else {
            $result = "Correct";
            //session_destroy();
        } return $result;
    }
    
    // public function show($guess)
    // {
    //     if ($guess != $this->number || $this->tries > 0) {
    //         $this->show = true; 
    //         return $this->show;
    //     }
    // }
}
