<?php
  require_once("templates/header.php");

  // Verifica se usuário está autenticado
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

  $movieDao = new MovieDAO($conn, $BASE_URL);

  $id = filter_input(INPUT_GET, "id");

  if(empty($id)) {

    $message->setMessage("O game não foi encontrado!", "error", "index.php");

  } else {

    $movie = $movieDao->findById($id);

    // Verifica se o game existe
    if(!$movie) {

      $message->setMessage("O game não foi encontrado!", "error", "index.php");

    }

  }

  

?>
  
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6 offset-md-1">
          <h1><?= $movie->title ?></h1>
          <p class="page-description">Altere os dados do game no formulário abaixo:</p>
          <form id="edit-movie-form" action="<?= $BASE_URL ?>movie_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?= $movie->id ?>">
            <div class="form-group">
              <label for="title">Título:</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do game" value="<?= $movie->title ?>">
            </div>
           
            <div class="form-group">
              <label for="category">Categoria:</label>
              <select name="category" id="category" class="form-control">
                <option value="">Selecione</option>
                <option value="Ação" <?= $movie->category === "Ação" ? "selected" : "" ?>>Ação</option>
                <option value="Aventura" <?= $movie->category === "Aventura" ? "selected" : "" ?>>Aventura</option>
                <option value="RPG" <?= $movie->category === "RPG" ? "selected" : "" ?>>RPG</option>
                <option value="Simulação" <?= $movie->category === "Simulação" ? "selected" : "" ?>>Simulação</option>
                <option value="Esportes" <?= $movie->category === "Esportes" ? "selected" : "" ?>>Esporte</option>
              </select>
            </div>
            <div class="form-group">
              <label for="trailer">Link:</label>
              <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer" value="<?= $movie->trailer ?>">
            </div>
            <div class="form-group">
              <label for="description">Descrição:</label>
              <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o game..."><?= $movie->description ?></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Editar Game">
          </form>
        </div>
        <div class="col-md-3">
          <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')"></div>
        </div>
      </div>
    </div>
  </div>

<?php
  require_once("templates/footer.php");
?>
