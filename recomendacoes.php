<?php
  require_once("templates/header.php");

  require_once("dao/MovieDAO.php");

  // DAO dos games
  $movieDao = new MovieDAO($conn, $BASE_URL);

  $latestMovies = $movieDao->getLatestMovies();

  $actionMovies = $movieDao->getMoviesByCategory("Ação");

 
?>

  <div id="main-container" class="container-fluid">
    <h1>Recomendações</h1>
    <h2 class="section-title">Novos Games</h2>
    <p class="section-description">Veja as críticas dos últimos games adicionados no Good Browser Games</p>
    <div class="movies-container">
      <?php foreach($latestMovies as $movie): ?>
        <?php require("templates/movie_card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($latestMovies) === 0): ?>
        <p class="empty-list">Ainda não há games cadastrados!</p>
      <?php endif; ?>
    </div>
    
  </div>
<?php
  require_once("templates/footer.php");
?>