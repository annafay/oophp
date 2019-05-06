<?php
/**
 * Guess my number, a POST version.
 */
require __DIR__ . "/config.php";
require __DIR__ . "/autoload.php";

// Start session.
session_name("antf18");
session_start();

// Variables
$guess = $_POST["guess"] ?? null;
$makeGuess = $_POST["makeGuess"] ?? null;
$cheat = $_POST["cheat"] ?? null;
$init = $_POST["init"] ?? null;
$result = null;

// Try and catch exception
try { 
    if (!isset($_SESSION["object"])) { // check if session has data stored
        // Init the game
        $_SESSION["object"] = new Guess(); //by making $_SESSION["object"] we only need to call the class once
        // Call function random 
        $_SESSION["object"]->random(); 
    }
    
    // Call functions from Guess.php
    $object = $_SESSION["object"];
    
    // Call function number. 
    $number = $object->number(); // fills number with number in use
    
    // Call function makeGuess 
    if (isset($makeGuess)) {
        $result = $object->makeGuess($guess);
    } 
    
    // Create new game.
    if (isset($init)) {        
        header("Location:index.php");
        session_destroy();
    }
} catch (GuessException $e) {
    echo "Got exception: " . get_class($e) . "<hr>";
}
// Call function tries. Get value $tries. Must be outside the Try and catch 
$tries = $object->tries(); // fills object with number of tries left
//$show = $object->show($guess);


// Call HTML and render the page
require __DIR__ . "/view/numbergame.php";
require __DIR__ . "/view/debug.php";
