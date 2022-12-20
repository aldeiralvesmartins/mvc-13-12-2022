<div class="container ">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link <?php if ($CURRENT_PAGE == "Index") {?>active<?php }?>" href="/?controller=home&acao=index">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($CURRENT_PAGE == "About") {?>active<?php }?>" href="/?controller=clientes&acao=index">Clientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($CURRENT_PAGE == "About") {?>active<?php }?>" href="/?controller=produtos&acao=index">Produtos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($CURRENT_PAGE == "About") {?>active<?php }?>" href="/?controller=pedidos&acao=index">Pedidos</a>
        </li>
    </ul>
    
</div>
