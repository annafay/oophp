<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game
 */
$app->router->get("guess/init", function () use ($app) {
    //init the session for the gamestart
    $game = new Fay\Guess\Guess();
    return $app->response->redirect("guess/play");
});

/**
 * Show the game
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";
    
    $data = [
        "guess" => $guess ?? null,
        "number" => $number ?? null,
        "tries" => $tries ?? null,
        "makeGuess" => $makeGuess ?? null,
        "cheat" => $cheat ?? null
    ];
    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");
    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the game";

    
    // Variables for the guessing game
    $guess = $_POST["guess"] ?? null;
    $makeGuess = $_POST["makeGuess"] ?? null;
    $cheat = $_POST["cheat"] ?? null;
    $init = $_POST["init"] ?? null;
    $result = null;
    
    // Test
    
    try { 
        if (!isset($_SESSION["object"])) { // check if session has data stored
            // Init the game
            $_SESSION["object"] = new Fay\Guess\Guess(); //by making $_SESSION["object"] we only need to call the class once
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
            //header("Location:guess/play.php");
            session_destroy();
        }
    } catch (GuessException $e) {
        echo "Got exception: " . get_class($e) . "<hr>";
    }
    // Call function tries. Get value $tries. Must be outside the Try and catch 
    $tries = $object->tries(); // fills object with number of tries left

    // Test slut 
    
    $data = [
        "guess" => $guess,
        "number" => $number,
        "tries" => $tries,
        "makeGuess" => $makeGuess,
        "cheat" => $cheat,
        "object" => $object,
        "result" => $result,
    ];

    $app->page->add("guess/play", $data);
    //$app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
