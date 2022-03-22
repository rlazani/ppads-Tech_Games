<?php

require 'config.php';
require 'src/Game.php';

$obj_game = new Game($mysql);
$game = $obj_game->encontrarPorId($_GET['id']);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Good Browser Games</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="container">
        <h1>
            <?php echo $game['titulo']; ?>
        </h1>
        <p>
            <?php echo $game['url']; ?>
        </p>
        <div>
            <a class="botao botao-block" href="index.php">Voltar</a>
        </div>
    </div>
</body>

</html>