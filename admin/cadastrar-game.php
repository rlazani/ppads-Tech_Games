<?php

require '../config.php';
require '../src/Game.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game = new Game($mysql);
    $game->adicionar($_POST['titulo'], $_POST['tipo']);

    header('Location: /browserGames/admin/index.php');
    die();
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <meta charset="UTF-8">
    <title>Cadastro de Game</title>
</head>

<body>
    <div id="container">
        <h1>Cadastrar Game</h1>
        <form action="cadastrar-game.php" method="post">
            <p>
                <label for="">Digite o título do game</label>
                <input class="campo-form" type="text" name="titulo" id="titulo" />
            </p>
            <p>
                <label for="">Digite o url do game</label>
                <textarea class="campo-form" type="text" name="tipo" id="tipo"></textarea>
            </p>
            <p>
                <button class="botao">Cadastrar Game</button>
            </p>
        </form>
    </div>
</body>

</html>