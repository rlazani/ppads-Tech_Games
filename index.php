<?php
  require_once("templates/header.php");

  require_once("dao/MovieDAO.php");

  // DAO dos games
  $movieDao = new MovieDAO($conn, $BASE_URL);

  $latestMovies = $movieDao->getLatestMovies();

  $actionMovies = $movieDao->getMoviesByCategory("Ação");

 
?>

<!--
<form action="<?= $BASE_URL ?>search.php" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
        <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar Games" aria-label="Search">
        <button type="submit">
          <i class="fas fa-search"></i>
        </button>
</form>
-->
  <div id="main-container" class="container-fluid">
    
    <center>
      <h1 class="index-h1">The Good Browser Games</h1>
    </center>
    
  </div>
<?php
  require_once("templates/footer.php");
?>