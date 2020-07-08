<?php
require_once '../../util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);

require_once '../../include/auto_load_path_2.php';
$cliente = new ClienteInstance();
$clienteBean = new ClienteBean();


$permissoes = PermissoesDao::getPermission_in_table($_SESSION['usu_codigo'], 'clientes');

$excluir = $permissoes['excluir'];
$atualizar = $permissoes['atualizar'];
$visualizar = $permissoes['visualizar'];


if ($visualizar == "N") {
    echo 'sem permissao para visualizar';
    exit();
}



$pagina = (isset($_GET['p'])) ? $_GET['p'] : 1;

$clienteBean = $cliente->c_burcar_todos_os_clientes();
$total = count($clienteBean);

$registros_por_pagina = 10;
$numPaginas = ceil($total / $registros_por_pagina);
$inicio = ($registros_por_pagina * $pagina) - $registros_por_pagina;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">      
        <title>Lista Cliente</title>

        <!-- Bootstrap -->
        <?php
        include_once '../obter_css.php';
        ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container-fluid">          
            <h1>Lista de Clientes</h1>
            <table class="table table-hover">

                <thead>
                    <tr>
                        <td>nome</td>
                        <td>fantasia</td>
                        <td>Vendedor</td>
                        <td>Cidade</td>   
                        <td>Bairro</td>
                        <td>Contato</td>    
                        <td>E-mail</td>    
                        <td>Ação</td>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $clienteBean = $cliente->c_paginacao_cliente($inicio, $registros_por_pagina);
                    $count = count($clienteBean);

                    foreach ($clienteBean as $cli) {
                        ?>

                        <tr>
                            <td><?php echo $cli->getCli_nome() ?></td>
                            <td><?php echo $cli->getCli_fantasia() ?></td>
                            <td><?php echo $cli->getUsu_nome() ?></td>                               
                            <td><?php echo $cli->getCid_nome() ?></td>
                            <td><?php echo $cli->getCli_bairro() ?></td>                              
                            <td><?php echo $cli->getCli_contato() ?></td>

                            <td><?php echo $cli->getCli_email() ?></td>

                            <?php if ($atualizar == "S"): ?>
                                <td><a  href="CadastraClientes.php?cli_codigo=<?php echo $cli->getCli_codigo() ?>"><i class="fas fa-pencil-alt"></i></a></td>
                            <?php endif; ?>

                            <?php if ($excluir == "S"): ?>
                                <td><a  href="javascript:if(confirm('deseja mesmo excluir o cliente <?php echo $cli->getCli_codigo() ?>')) {location='CadastraClientes.php?acao=excluir&cli_codigo=<?php echo $cli->getCli_codigo() ?>';}   "><i class="fas fa-trash-alt"></i></a></td>
                            <?php endif; ?>

                        </tr>
                    <?php } ?>




                </tbody>
            </table>

            <nav>
                <ul class="pagination">
                    <?php
                    //mostrando a paginacao

                    $anterior = $pagina - 1;
                    $proxima = $pagina + 1;

                    // Página anterior
                    if ($pagina > 1) {
                        echo "<li class='disabled'><a href='Listar_clientes.php?p=$anterior' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                    } else {
                        echo "<li class='disabled'><a href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                    }


                    // Páginas subsequentes
                    for ($i = 1; $i < $numPaginas + 1; $i++) {
                        echo "<li><a href='Listar_clientes.php?p=$i'> " . $i . "  </a></li>";
                    }


                    // Página anterior
                    if ($pagina < $numPaginas) {
                        echo "<li><a href='Listar_clientes.php?p=$proxima' aria-label='Próximo'><span aria-hidden='true'>&raquo;</span></a></li>";
                    } else {
                        echo "<li><a href='#' aria-label='Próximo'><span aria-hidden='true'>&raquo;</span></a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>

        <div class="alert alert-success" role="alert"><?php echo 'foram encontrados ' . $count . ' cliente(s)' . ' de ' . $total ?></div>
    </body>
</html>