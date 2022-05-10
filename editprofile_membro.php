<?php
  require_once("templates/header.php");

  require_once("models/Membro.php");
  require_once("dao/MembroDAO.php");

  $membro = new Membro();
  $membroDao = new MembroDao($conn, $BASE_URL);

  $membroData = $membroDao->verifyToken(true);

  $fullName = $membro->getFullName($membroData);
  
?>

  <div id="main-container" class="container-fluid edit-profile-page">
  
  <form action="<?= $BASE_URL ?>search.php" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
        <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar Games" aria-label="Search">
        <input type="submit" class="btn card-btn" value="Buscar">
  </form>

  <center>
    <h1 class="edit-profile-h1"><?= $fullName ?></h1>
  </center>
  
    <div class="col-md-12 edicao-profile">
      <form action="<?= $BASE_URL ?>membro_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="update">
        <div class="row">
          <div class="col-md-4">
            <p class="page-description">Alterar dados de membro:</p>
            <div class="form-group">
              <label for="name">Nome:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Digite o seu nome" value="<?= $membroData->name ?>">
            </div>
            <div class="form-group">
              <label for="lastname">Sobrenome:</label>
              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite o seu nome" value="<?= $membroData->lastname ?>">
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="text" readonly class="form-control disabled" id="email" name="email" placeholder="Digite o seu nome" value="<?= $membroData->email ?>">
            </div>
            <input type="submit" class="btn card-btn" value="Alterar">
          </div>
      </form>
     
        <div class="col-md-4 col-alterar-senha">
          <p>Alterar a senha:</p>
          <form action="<?= $BASE_URL ?>membro_process.php" method="POST">
            <input type="hidden" name="type" value="changepassword">
            <div class="form-group">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Digite a sua nova senha">
            </div>
            <div class="form-group">
              <label for="confirmpassword">Confirmação de senha:</label>
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme a sua nova senha">
            </div>
            <input type="submit" class="btn card-btn" value="Alterar Senha">
          </form>
        </div>
      </div>
    </div>
  </div>

<?php
  require_once("templates/footer.php");
?>