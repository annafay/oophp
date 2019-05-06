<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<?php include(__DIR__ . "/header.php"); ?>
<h3>You have <?= $tries ?> tries left. </h3>

<form method="post">
    <?php if ($tries > 0 /*|| $guess != $number*/) : ?>
        <input type="text" name="guess">
    <?php endif ?>
    <input type="hidden" name="number" value="<?= $number ?>">
    <input type="hidden" name="tries" value="<?= $tries ?>">
    <?php if ($tries > 0 /*|| $guess != $number*/) : ?>
        <input type="submit" name="makeGuess" value="Make a guess">
    <?php endif ?>
    <input type="submit" name="init" value="New game">
    <?php if ($tries > 0 /*|| $guess != $number*/) : ?>
        <input type="submit" name="cheat" value="Cheat">
    <?php endif ?>
</form>
<p>
<?php if ($makeGuess) : ?>
    You guessed <?= $guess ?>. <?= $result ?>
<?php endif ?>
<?php if ($cheat) : ?>
    The number is <?= $number ?>.
<?php endif ?>
<?php if ($tries === 0 /*|| $guess === $number*/) : ?>
    Start a new game. 
<?php endif ?>
</p>
<?php include(__DIR__ . "/footer.php"); ?>
