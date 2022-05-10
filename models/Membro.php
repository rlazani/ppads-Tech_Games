<?php

//Membro

  class Membro {

    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    /*public $image;
    public $bio;*/
    public $token;

    public function getFullName($membro) {
      return $membro->name . " " . $membro->lastname;
    }

    public function generateToken() {
      return bin2hex(random_bytes(50));
    }
    
    public function generatePassword($password) {
      return password_hash($password, PASSWORD_DEFAULT);
    }

    public function imageGenerateName() {
      return bin2hex(random_bytes(60)) . ".jpg";
    }

  }

  interface membroDAOInterface {

    public function buildmembro($data);
    public function create(membro $membro, $authmembro = false);
    public function update(membro $membro, $redirect = true);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticatemembro($email, $password);
    public function findByEmail($email);
    public function findById($id);
    public function findByToken($token);
    public function destroyToken();
    public function changePassword(membro $membro);

  }