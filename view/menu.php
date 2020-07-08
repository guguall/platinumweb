<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once './session.php';
inicializa_sessao('600', 2);
?>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">PlatinumWeb</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-left">

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-ul"></i> Cadastros<span class="caret"></span></a>
            <ul class="dropdown-menu">

                <li class="dropdown-header">Administração</li>
                <li><a target="Frame1"  href="USUARIOS/CadastroUsuarios.php"><i class="fa fa-users"></i> Usuários</a></li>
                <li><a target="Frame1"  href="CLIENTES/CadastraClientes.php"><i class="fa fa-user-plus"></i> Clientes</a></li>

                <li><a target="Frame1"  href="CATEGORIAS/CadastraCategorias.php"><i class="fa fa-certificate"></i> Categorias</a></li>
                <li><a target="Frame1"  href="FORNECEDOR/CadastraFornecedor.php"><i class="fa fa-suitcase"></i> Fornecedores</a></li>
                <li><a target="Frame1"  href="PRODUTOS/CadastraProdutos.php"><i class="fa fa-barcode"></i> Produtos</a></li>

                <li role="separator" class="divider"></li>
                <li><a href="#">Action</a></li>  
            </ul>
        </li>



        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-ul"></i> Listagens<span class="caret"></span></a>
            <ul class="dropdown-menu">

                <li class="dropdown-header">Administração</li>
                <li><a target="Frame1"  href="CLIENTES/Listar_clientes.php"><i class="fa fa-users"></i> Lista de Clientes</a></li>
                <li><a target="Frame1"  href="USUARIOS/listar_usuarios.php"><i class="fa fa-users"></i> Lista de Vendedores</a></li>
                <li><a target="Frame1"  href="PRODUTOS/ListaProdutos.php"><i class="fa fa-users"></i> Lista de Produtos</a></li>
                <li><a target="Frame1"  href="USUARIOS/listar_usuarios.php"><i class="fa fa-users"></i> Lista de Usuarios</a></li>
                <li><a target="Frame1"  href="CLIENTES/Tabela_com_pesquisa.php"><i class="fa fa-users"></i>Exmplo Lista Pesquisa</a></li>



                <li role="separator" class="divider"></li>
                <li><a href="#">Action</a></li>  
            </ul>
        </li>

        <li><a target="Frame1"  href="ENTRPRODUTO/CadastraEntradaProduto.php"><i class="fa fa-windows"></i> Entrada de Produtos</a></li>

        <li><a target="Frame1"  href="BOLETOS/lista-boletos.php"><i class="fa fa-windows"></i> Boletos</a></li>

        <?php if ($_SESSION['usu_nivel'] == "ADM"): ?>
            <li><a target="Frame1"  href="PERMISSOES/lista-usuarios-permissao.php"><i class="fas fa-lock"></i> Permissões</a></li>
        <?php endif; ?>


        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a target="Frame1" href="USUARIOS/CadastroUsuarios.php?usu_codigo=<?php echo $_SESSION["usu_codigo"] ?>"><i class="fa fa-user fa-fw"></i>Profile</a>
                </li>

                <li class="divider"></li>
                <li><a href="logoff.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>




        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">

                        Logado : <?php echo $_SESSION["usu_email"] ?>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a target="Frame1" href="home.php"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-list-ul fa-fw"></i> Vendas<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a target="Frame1" href="VENDAS/listar_todas_vendas.php">Listar vendas</a>
                        <li><a target="Frame1"  href="VENDAS/mestre-detalhe.php"><i class="fa fa-windows"></i>Exemplo Master-Detail</a></li>
                </li>

            </ul>
            <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Relatórios de vendas<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a target="Frame1" href="VENDAS/pesquisa_vendas_por_cliente.php">Rel.Vendas p/ Cliente</a>
                    </li>
                    <li>
                        <a target="Frame1" href="VENDAS/pesquisa_vendas_por_vendedor.php">Rel.Vendas p/ Vendedor</a>
                    </li>
                    <li>
                        <a target="Frame1" href="VENDAS/pesquisa_vendas_por_periodo.php">Rel.Vendas p/ Período</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a target="Frame1" href="VENDAS/geo_localizacao.php">Geo Localizador de vendas</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Contas a Receber<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="blank.html">Por cliente</a>
                    </li>
                    <li>
                        <a href="login.html">Vencidas</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>