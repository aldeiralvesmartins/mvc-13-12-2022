<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "vendor/autoload.php";

$controller = $_GET['controller'];
$acao = !empty($_GET['acao']) ? $_GET['acao'] : null;
$id = !empty($_GET['id']) ? $_GET['id'] : null;

switch ($controller) {
    case 'clientes';
        $controller = new \App\Controllers\ClientesController(
            new \App\Models\ClientesModel()
        );
        break;
    case 'produtos':
        $controller = new \App\Controllers\ProdutosController(
            new \App\Models\ProdutosModel()
        );
        break;
    case 'pedidos':
        $controller = new \App\Controllers\PedidosController(
            new \App\Models\PedidosModel(),
            new \App\Models\ClientesModel(),
            new \App\Models\ProdutosModel(),
            new \App\Models\ItensPedidosModel()
        );
        break;

    case 'home':
        $controller = new \App\Controllers\HomeController(new \App\Models\ProdutosModel());
        break;
        
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include("./src/includes/head.php"); ?>
</head>

<body>

    <?php //include("./src/includes/design-top.php");
    ?>
    <?php include("./src/includes/navigation.php"); ?>

    <div class="container" id="main-content">
        <?php
        $controller->$acao($id);
        if (!empty($controller->msg)) echo "<div class='alert alert-primary' role='alert'>{$controller->msg}</div>";
        if (!empty($controller->msgDanger)) echo "<div class='alert alert-danger' role='alert'>{$controller->msgDanger}</div> ";

        ?>

    </div>

    <?php include("./src/includes/footer.php"); ?>

</body>

</html>