<?php

require '../config.php';
include '../src/Game.php';

$game = new Game($mysql);
$games = $game->exibirTodos();

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Página administrativa</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
    <div id="container">
        <h1>Página Administrativa</h1>
        <div>
            <?php foreach ($games as $gam) { ?>
            <div id="artigo-admin">
                <p><?php echo $gam['titulo']; ?></p>
                <nav>
                    <a class="botao" href="editar-game.php?id=<?php echo $gam['id']; ?>">Editar</a>
                    <a class="botao" href="excluir-game.php?id=<?php echo $gam['id']; ?>">Excluir</a>
                </nav>
            </div>
            <?php } ?>
        </div>
        <a class="botao botao-block" href="cadastrar-game.php">Cadastrar Game</a>
    </div>
</body>

</html>