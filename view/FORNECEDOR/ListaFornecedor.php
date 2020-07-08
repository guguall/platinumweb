<?php
require_once '../../util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);
require_once '../../include/auto_load_path_2.php';
$fornecedor = new FornecedoresInstance();
$fornecedorBean = new FornecedoresBean();
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <title></title>
        <?php
        include_once '../obter_css.php';
        ?>


    </head>

    <body>
        <br/>
        <div class="container-fluid">          
            <h1>Lista de Fornecedores</h1>
            <table class="table table-hover">

                <thead>
                    <tr>
                        <td>Razão-Social</td>
                        <td>Nome-Fantasia</td>   
                        <td>Cidade</td>   
                        <td>Contato</td>                              
                        <td>CPF/CNPJ</td>
                        <td>E-mail</td>
                        <td>Ação</td>
                    </tr>

                </thead> 

                <tbody>
                    <?php
                    $fornecedorBean = $fornecedor->C_buscaTodosFornecedores();
                    $count = count($fornecedorBean);
                    foreach ($fornecedorBean as $p) {
                        ?>
                        <tr>

                            <td class="blog-post-meta"><a  href="CadastraFornecedor.php?for_codigo=<?php echo $p->getFor_codigo() ?>">   <?php echo $p->getFor_razaosocial() ?>      </a></td>
                            <td class="blog-post-meta"><a  href="CadastraFornecedor.php?for_codigo=<?php echo $p->getFor_codigo() ?>"><?php echo $p->getFor_fantasia() ?> </a> </td>   
                            <td class="blog-post-meta"><a  href="CadastraFornecedor.php?for_codigo=<?php echo $p->getFor_codigo() ?>"><?php echo $p->getCid_nome() ?> </a> </td>   
                            <td class="blog-post-meta"><a  href="CadastraFornecedor.php?for_codigo=<?php echo $p->getFor_codigo() ?>"><?php echo $p->getFor_contato1() ?></a>  </td>
                            <td class="blog-post-meta"><a  href="CadastraFornecedor.php?for_codigo=<?php echo $p->getFor_codigo() ?>"><?php echo $p->getFor_cnpjcpf() ?></a>  </td>
                            <td class="blog-post-meta"><a  href="CadastraFornecedor.php?for_codigo=<?php echo $p->getFor_codigo() ?>"><?php echo $p->getFor_email() ?> </a> </td>

                            <td><a  href="javascript:if(confirm('deseja mesmo excluir o fornecedor <?php echo $p->getFor_codigo() ?>')) {location='CadastraFornecedor.php?acao=excluir&for_codigo=<?php echo $p->getFor_codigo() ?>';}   "><i class="fas fa-trash-alt"></i></a></td>

                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>

            <div class="alert alert-success" role="alert"><?php echo 'foram encontrados ' . $count . ' fornecedor(es)' ?></div> 

        </div>
        </div>

</html>

