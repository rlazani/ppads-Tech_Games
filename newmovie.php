<?php
  require_once("templates/header.php");

  // Verifica se usuário está autenticado
  require_once("models/User.php");
  require_once("dao/UserDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

?>
  <div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 new-movie-container">
      <h1 class="page-title">Adicionar Game</h1>
      <form action="<?= $BASE_URL ?>movie_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="create">
        <div class="form-group">
          <label for="title">Título:</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do game">
        </div>
        
        <div class="form-group">
          <label for="category">Categoria:</label>
          <select name="category" id="category" class="form-control">
            <option value="">Selecione</option>
            <option value="Ação">Ação</option>
            <option value="Aventura">Aventura</option>
            <option value="RPG">RPG</option>
            <option value="Simulação">Simulação</option>
            <option value="Esportes">Esportes</option>
          </select>
        </div>

        <div class="form-group">
          <label for="trailer">Link:</label>
          <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do game">
        </div>
        <div class="form-group">
          <label for="description">Descrição:</label>
          <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o game..."></textarea>
        </div>
        <input type="submit" class="btn card-btn" value="Adicionar game">
      </form>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>