<?php

require 'config.php';

include 'src/Game.php';

$game = new Game($mysql);
$games = $game->exibirTodos();

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
        <h1>Good Browser Games</h1>
        <h2>Games Cadastrados</h2>
            </br>
            <?php foreach ($games as $game) : ?>
            <h2>
            <a href="game.php?id=<?php echo $game['id']; ?>">
                <?php echo $game['titulo']; ?>
            </a>
            </h2>
            <p>
                <?php echo $game['url']; ?>
            </p>
            </br>
            <?php endforeach; ?>
    </div>
</body>

</html>