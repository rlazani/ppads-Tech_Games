<?php

class Game
{

    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function testando()
    {

    }

    public function exibirTodos(): array
    {
        $resultado = $this->mysql->query('SELECT * FROM games');
        $games = $resultado->fetch_all(MYSQLI_ASSOC); // transforma query em um array
        
        return $games;
    }


    public function encontrarPorId(string $id): array
    {
        $selecionaGame = $this->mysql->prepare("SELECT * FROM games WHERE id = ?");
        $selecionaGame->bind_param('s', $id);
        $selecionaGame->execute();
        $game = $selecionaGame->get_result()->fetch_assoc();
        return $game;
    }


} // 

