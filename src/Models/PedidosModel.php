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
            $cmd = $this->conn->prepare("INSERT INTO  pedidos (cliente_id, data,status) VALUES (:c,:d,:s)");
            $cmd->bindValue(":c", $dados['cliente_id']);
            $cmd->bindValue(":d", $dados['data']);
            $cmd->bindValue(":s", $dados['status']);
            $cmd->execute();
            $cmd = $this->conn->prepare("SELECT LAST_INSERT_ID()");
            $cmd->execute();
            $id = $cmd->fetchAll(PDO::FETCH_COLUMN);
            return $id[0];
    }

    public function getAll()
    {
        $cmd = $this->conn->prepare("SELECT pedidos.id, data, status, clientes.nome FROM pedidos
        inner join clientes on (clientes.id = pedidos.cliente_id)");
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function excluir($id)
    {
        $cmd = $this->conn->prepare(" DELETE itens_pedidos
                                      FROM itens_pedidos                                      
                                      WHERE itens_pedidos.pedido_id = '$id'");
        $cmd->execute();

        $cmd = $this->conn->prepare(" DELETE pedidos 
                                      FROM pedidos                                      
                                      WHERE id = '$id'");
        $cmd->execute();
    }

    public function editar($dados)
    {
        $cmd = $this->conn->prepare("UPDATE pedidos SET cliente_id = :c, data = :d, status = :s WHERE id = :id");
        $cmd->bindValue(":c", $dados['pedido']['cliente_id']);
        $cmd->bindValue(":d", $dados['pedido']['data']);
        $cmd->bindValue(":s", $dados['pedido']['status']);
        $cmd->bindValue(":id", $dados['id']);
        $cmd->execute();
        return $cmd->fetchAll();
    }

    public function getById($id)
    {
        $cmd = $this->conn->prepare("SELECT * FROM pedidos where id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }
}
