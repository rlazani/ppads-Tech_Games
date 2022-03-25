<?php

require '../config.php';
include '../src/Game.php';
require '../src/redireciona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game = new Game($mysql);
    $game->remover($_POST['id']);

    redireciona('/browserGames/admin/index.php');
}


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <meta charset="UTF-8">
    <title>Excluir Game</title>
</head>

<body>
    <div id="container">
        <h1>Você realmente deseja excluir o game?</h1>
        <form method="post" action="excluir-game.php">
            <p>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <button class="botao">Excluir</button>
            </p>
        </form>
    </div>
</body>

</html>