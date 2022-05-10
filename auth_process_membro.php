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

  // Verificação do tipo de formulário
  if($type === "register") {

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Verificação de dados mínimos 
    if($name && $lastname && $email && $password) {

      // Verificar se as senhas batem
      if($password === $confirmpassword) {

        // Verificar se o e-mail já está cadastrado no sistema
        if($membroDao->findByEmail($email) === false) {

          $membro = new Membro();

          // Criação de token e senha
          $userToken = $membro->generateToken();
          $finalPassword = $membro->generatePassword($password);

          $membro->name = $name;
          $membro->lastname = $lastname;
          $membro->email = $email;
          $membro->password = $finalPassword;
          $membro->token = $userToken;

          $auth = true;

          $membroDao->create($membro, $auth);

        } else {
          
          // Enviar uma msg de erro, usuário já existe
          $message->setMessage("Usuário já cadastrado, tente outro e-mail.", "error", "back");

        }

      } else {

        // Enviar uma msg de erro, de senhas não batem
        $message->setMessage("As senhas não são iguais.", "error", "back");

      }

    } else {

      // Enviar uma msg de erro, de dados faltantes
      $message->setMessage("Por favor, preencha todos os campos.", "error", "back");

    }

  } else if($type === "login") {

    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    // Tenta autenticar membro
    if($membroDao->authenticateMembro($email, $password)) {

      $message->setMessage("Seja bem-vindo!", "success", "editprofile_membro.php");

    // Redireciona o usuário, caso não conseguir autenticar
    } else {

      $message->setMessage("Usuário e/ou senha incorretos.", "error", "back");

    }

  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }