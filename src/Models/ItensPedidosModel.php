<?php

namespace App\Models;

use App\Conexao\Conexao;
use PDO;

class ItensPedidosModel extends Conexao
{
  

    public function __construct()
    {
        parent::__construct();

    }

    public function cadastrar($dados)
    {
            $cmd = $this->conn->prepare("INSERT INTO  itens_pedidos (produto_id, quantidade,valor_unitario,pedido_id) VALUES (:pro_id,:q,:val_u,:ped_id)");
            $cmd->bindValue(":pro_id", $dados['produto_id']);
            $cmd->bindValue(":q", $dados['quantidade']);
            $cmd->bindValue(":val_u", $dados['valor_unitario']);
            $cmd->bindValue(":ped_id", $dados['pedido_id']);
            $cmd->execute();
    }


    public function getAll()
    {
        $res = array();
        $cmd = $this->conn->prepare("SELECT * FROM itens_pedidos");
        $cmd->execute();
        $res = $cmd->fetchAll();
        return $res;
    }


    public function editar($dados)
    {
        $cmd = $this->conn->prepare("UPDATE itens_pedidos SET cliente_id = :c, data = :d, status = :s WHERE id = :id");
        $cmd->bindValue(":c", $dados['cliente_id']);
        $cmd->bindValue(":d", $dados['data']);
        $cmd->bindValue(":s", $dados['status']);
        $cmd->bindValue(":id", $dados['id']);
        $cmd->execute();
        return $cmd->fetchAll();
    }

    public function getById($id)
    {
        $cmd = $this->conn->prepare("SELECT * FROM itens_pedidos where pedido_id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }

    public function getByPedidoId($id)
    {
        $cmd = $this->conn->prepare("SELECT * FROM itens_pedidos where pedido_id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }
}
