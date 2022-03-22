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
        <h1>Games Cadastrados</h1>
            <?php foreach ($games as $game) : ?>
            <h2>
            <a href="game.php?id=<?php echo $game['id']; ?>">
                <?php echo $game['titulo']; ?>
            </a>
            </h2>
            <p>
                <?php echo $game['url']; ?>
            </p>
            <?php endforeach; ?>
    </div>
</body>

</html>