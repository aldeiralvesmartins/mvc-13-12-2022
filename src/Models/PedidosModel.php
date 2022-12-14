<?php

namespace App\Models;

use App\Conexao\Conexao;
use PDO;

class PedidosModel extends Conexao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function cadastrar($dados)
    {
        $cmd = $this->conn->prepare("SELECT id  FROM pedidos WHERE cliente_id = :c");
        $cmd->bindValue(":c", $dados['cliente_id']);
        $cmd->execute();

        if ($cmd->rowcount() > 0) {
            return false;
        } else {
            $cmd = $this->conn->prepare("INSERT INTO  pedidos (cliente_id, data,status) VALUES (:c,:d,:s)");
            $cmd->bindValue(":c", $dados['cliente_id']);
            $cmd->bindValue(":d", $dados['data']);
            $cmd->bindValue(":s", $dados['status']);
            $cmd->execute();
        }
    }


    public function getAll()
    {
        $res = array();
        $cmd = $this->conn->prepare("SELECT * FROM pedidos");
        $cmd->execute();
        $res = $cmd->fetchAll();
        return $res;
    }


    public function excluir($id)
    {
        $cmd = $this->conn->prepare("DELETE FROM pedidos where id = :id");
        $cmd->bindValue(":id", $id);
        return $cmd->execute();
    }

    public function editar($dados)
    {
        $cmd = $this->conn->prepare("UPDATE pedidos SET cliente_id = :c, data = :d, status = :s WHERE id = :id");
        $cmd->bindValue(":c", $dados['cliente_id']);
        $cmd->bindValue(":d", $dados['data']);
        $cmd->bindValue(":s", $dados['status']);
        $cmd->execute();
        return $cmd->fetchAll();
    }

    public function getById($id)
    {
        $res = array();
        $cmd = $this->conn->prepare("SELECT * FROM pedidos where id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }
}
