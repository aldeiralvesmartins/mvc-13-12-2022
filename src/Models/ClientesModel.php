<?php

namespace App\Models;

use App\Conexao\Conexao;
use PDO;

class ClientesModel extends Conexao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function cadastrar($dados)
    {
        $cmd = $this->conn->prepare("SELECT id  FROM clientes WHERE cpf = :c");
        $cmd->bindValue(":c", $dados['cpf']);
        $cmd->execute();

        if ($cmd->rowcount() > 0) {
            return false;
        } else {
            $cmd = $this->conn->prepare("INSERT INTO  clientes (nome, cpf) VALUES (:n, :c)");
            $cmd->bindValue(":n", $dados['nome']);
            $cmd->bindValue(":c", $dados['cpf']);
            $cmd->execute();
        }
    }


    public function getAll()
    {
        $res = array();
        $cmd = $this->conn->prepare("SELECT * FROM clientes");
        $cmd->execute();
        $res = $cmd->fetchAll();
        return $res;
    }


    public function excluir($id)
    {
        $cmd = $this->conn->prepare("DELETE FROM clientes where id = :id");
        $cmd->bindValue(":id", $id);
        return $cmd->execute();
    }

    public function editar($dados)
    {
        $cmd = $this->conn->prepare("UPDATE clientes SET cpf = :c, nome = :n WHERE id = :id");
        $cmd->bindValue(":c", $dados['cpf']);
        $cmd->bindValue(":n", $dados['nome']);
        $cmd->bindValue(":id", $dados['id']);
        $cmd->execute();
        return $cmd->fetchAll();
    }

    public function getById($id)
    {
        $res = array();
        $cmd = $this->conn->prepare("SELECT * FROM clientes where id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }
}
