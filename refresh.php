<?php


///////////////////////


$text = file_get_contents("live_player.txt");
$live_movie = explode("%", $text);

$live_movie[0] = str_replace('\\', '/', $live_movie[0]);

?>

    <a class="btn btn-success center" href='index.php?vid=<?= $live_movie[0] . "&t=" . $live_movie[2] ?>'>Ouvir le direct dans le lecteur</a>
