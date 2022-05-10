<?php

  require_once("globals.php");
  require_once("db.php");
  require_once("models/Membro.php");
  require_once("models/Message.php");
  require_once("dao/MembroDAO.php");

  $message = new Message($BASE_URL);

  $membroDao = new MembroDAO($conn, $BASE_URL);

  // Resgata o tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  // Atualizar usuário
  if($type === "update") {

    // Resgata dados do usuário
    $membroData = $membroDao->verifyToken();

    // Receber dados do post
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");

    // Criar um novo objeto de usuário
    $membro = new Membro();

    // Preencher os dados do usuário
    $membroData->name = $name;
    $membroData->lastname = $lastname;
    $membroData->email = $email;
    $membroData->bio = $bio;

   

    $membroDao->update($membroData);

  // Atualizar senha do usuário
  } else if($type === "changepassword") {

    // Receber dados do post
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Resgata dados do usuário
    $membroData = $membroDao->verifyToken();
    
    $id = $membroData->id;

    if($password == $confirmpassword) {

      // Criar um novo objeto de usuário
      $membro = new Membro();

      $finalPassword = $membro->generatePassword($password);

      $membro->password = $finalPassword;
      $membro->id = $id;

      $membroDao->changePassword($membro);

    } else {
      $message->setMessage("As senhas não são iguais!", "error", "back");
    }

  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }