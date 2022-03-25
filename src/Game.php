<?php

class Game
{

    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function remover(string $id): void
    {
        $removerGame = $this->mysql->prepare('DELETE FROM games WHERE id = ?');
        $removerGame->bind_param('s', $id);
        $removerGame->execute();
    }

    public function adicionar(string $titulo, string $tipo): void
    {
        $insereGame = $this->mysql->prepare('INSERT INTO games (titulo, tipo) VALUES(?,?);');
        $insereGame->bind_param('ss', $titulo, $tipo);
        $insereGame->execute();
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

    public function editar(string $id, string $titulo, string $url): void
    {
        $editaGame = $this->mysql->prepare('UPDATE games SET titulo = ?, url = ? WHERE id = ?');
        $editaGame->bind_param('sss', $titulo, $url, $id);
        $editaGame->execute();
    }


} // 

