<?php

  require_once("models/Membro.php");
  require_once("models/Message.php");

  class MembroDAO implements MembroDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    }

    public function buildMembro($data) {

      $membro = new Membro();

      $membro->id = $data["id"];
      $membro->name = $data["name"];
      $membro->lastname = $data["lastname"];
      $membro->email = $data["email"];
      $membro->password = $data["password"];
      $membro->image = $data["image"];
      $membro->bio = $data["bio"];
      $membro->token = $data["token"];

      return $membro;

    }

    public function create(Membro $membro, $authMembro = false) {

      $stmt = $this->conn->prepare("INSERT INTO membros(
          name, lastname, email, password, token
        ) VALUES (
          :name, :lastname, :email, :password, :token
        )");

      $stmt->bindParam(":name", $membro->name);
      $stmt->bindParam(":lastname", $membro->lastname);
      $stmt->bindParam(":email", $membro->email);
      $stmt->bindParam(":password", $membro->password);
      $stmt->bindParam(":token", $membro->token);

      $stmt->execute();

      // Autenticar membro, caso auth seja true
      if($authMembro) {
        $this->setTokenToSession($membro->token);
      }

    }

    public function update(Membro $membro, $redirect = true) {

      $stmt = $this->conn->prepare("UPDATE membros SET
        name = :name,
        lastname = :lastname,
        email = :email,
        image = :image,
        bio = :bio,
        token = :token
        WHERE id = :id
      ");

      $stmt->bindParam(":name", $membro->name);
      $stmt->bindParam(":lastname", $membro->lastname);
      $stmt->bindParam(":email", $membro->email);
      $stmt->bindParam(":image", $membro->image);
      $stmt->bindParam(":bio", $membro->bio);
      $stmt->bindParam(":token", $membro->token);
      $stmt->bindParam(":id", $membro->id);

      $stmt->execute();

      if($redirect) {

        // Redireciona para o perfil do membro
        $this->message->setMessage("Dados atualizados com sucesso!", "success", "editprofile_membro.php");

      }

    }

    public function verifyToken($protected = false) {

      if(!empty($_SESSION["token"])) {

        // Pega o token da session
        $token = $_SESSION["token"];

        $membro = $this->findByToken($token);

        if($membro) {
          return $membro;
        } else if($protected) {

          // Redireciona usuário não autenticado
          $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");

        }

      } else if($protected) {

        // Redireciona usuário não autenticado
        $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");

      }

    }

    public function setTokenToSession($token, $redirect = true) {

      // Salvar token na session
      $_SESSION["token"] = $token;

      if($redirect) {

        // Redireciona para o perfil do usuario
        $this->message->setMessage("Seja bem-vindo!", "success", "editprofile_membro.php");

      }

    }

    public function authenticateMembro($email, $password) {

      $membro = $this->findByEmail($email);

      if($membro) {

        // Checar se as senhas batem
        if(password_verify($password, $membro->password)) {

          // Gerar um token e inserir na session
          $token = $membro->generateToken();

          $this->setTokenToSession($token, false);

          // Atualizar token no usuário
          $membro->token = $token;

          $this->update($membro, false);

          return true;

        } else {
          return false;
        }

      } else {

        return false;

      }

    }

    public function findByEmail($email) {

      if($email != "") {

        $stmt = $this->conn->prepare("SELECT * FROM membros WHERE email = :email");

        $stmt->bindParam(":email", $email);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $membro = $this->buildMembro($data);
          
          return $membro;

        } else {
          return false;
        }

      } else {
        return false;
      }

    }

    public function findById($id) {

      if($id != "") {

        $stmt = $this->conn->prepare("SELECT * FROM membros WHERE id = :id");

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $membro = $this->buildMembro($data);
          
          return $membro;

        } else {
          return false;
        }

      } else {
        return false;
      }
    }

    public function findByToken($token) {

      if($token != "") {

        $stmt = $this->conn->prepare("SELECT * FROM membros WHERE token = :token");

        $stmt->bindParam(":token", $token);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $membro = $this->buildMembro($data);
          
          return $membro;

        } else {
          return false;
        }

      } else {
        return false;
      }

    }

    public function destroyToken() {

      // Remove o token da session
      $_SESSION["token"] = "";

      // Redirecionar e apresentar a mensagem de sucesso
      $this->message->setMessage("Você fez o logout com sucesso!", "success", "index.php");

    }

    public function changePassword(Membro $membro) {

      $stmt = $this->conn->prepare("UPDATE membros SET
        password = :password
        WHERE id = :id
      ");

      $stmt->bindParam(":password", $membro->password);
      $stmt->bindParam(":id", $membro->id);

      $stmt->execute();

      // Redirecionar e apresentar a mensagem de sucesso
      $this->message->setMessage("Senha alterada com sucesso!", "success", "editprofile_membro.php");

    }

  }