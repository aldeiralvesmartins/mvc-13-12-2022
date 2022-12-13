<?php
namespace App\Conexao;

use PDO;
use PDOException;

define('BD_HOST', 'localhost:3306');
define('BD_USUARIO', 'root');
define('BD_SENHA', 'r2147258369');
define('BD_BANCO', 'mvc');

class Conexao
{

    protected $conn;



    public function __construct()
    {
        $this->conectar();
    }

    private function conectar()
    {
        try
        {
        $this->conn = new PDO('mysql:host='.BD_HOST.';dbname='.BD_BANCO, BD_USUARIO, BD_SENHA);
        }
        catch(PDOException $e)
        {
            echo "erro!".$e->getMessage();
            die();
        }
    }
}