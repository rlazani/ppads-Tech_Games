<?php

require '../config.php';
include '../src/Game.php';
require '../src/redireciona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game = new Game($mysql);
    $game->editar($_POST['id'], $_POST['titulo'], $_POST['url']);

    redireciona('/browserGames/admin/index.php');
}

$game = new Game($mysql);
$gam = $game->encontrarPorId($_GET['id']);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <meta charset="UTF-8">
    <title>Editar Artigo</title>
</head>

<body>
    <div id="container">
        <h1>Editar Artigo</h1>
        <form action="editar-game.php" method="post">
            <p>
                <label for="titulo">Digite o novo título do artigo</label>
                <input class="campo-form" type="text" name="titulo" id="titulo" value="<?php echo $gam['titulo']; ?>" />
            </p>
            <p>
                <label for="url">Digite o novo url do artigo</label>
                <textarea class="campo-form" type="text" name="url" id="titulo"><?php echo $gam['url']; ?></textarea>
            </p>
            <p>
                <input type="hidden" name="id" value="<?php echo $gam['id']; ?>" />
            </p>
            <p>
                <button class="botao">Editar Game</button>
            </p>
        </form>
    </div>
</body>

</html>