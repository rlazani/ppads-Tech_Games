<?php

require '../config.php';
include '../src/Game.php';

$game = new Game($mysql);
$games = $game->exibirTodos();

/*Atributos dos games: nome, categoria, url, descrição, */

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Página de Cadastros de Games</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
    <div id="container">
        <h1>Good Browser Games</h1>
        <h2>Página de Cadastro de Games</h2>
        <div>
            <?php foreach ($games as $gam) { ?>
            <div id="artigo-admin">
                <a href="../game.php?id=<?php echo $gam['id']; ?>">
                    <p><?php echo $gam['titulo']; ?></p>
                </a>
                <br>
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