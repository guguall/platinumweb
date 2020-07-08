<?php
require_once '../../Util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <script type="text/javascript" src="../js/jquery-2.2.4.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.js"></script>
        <script type="text/javascript" src="../js/jquery.mask.js"></script>
        <script type="text/javascript" src="../js/script-carne.js"></script>
        <title>CursoAppVendas >> Emissão de Carnê | Gerencianet</title>
    </head>
    <body>

        <?php
        require_once '../../include/auto_load_path_2.php';

        $venda = new VendaCInstance();
        $vendac = new VendaCBean();

        $cli = new ClienteInstance();
        $cliente = new ClienteBean();

        $confpgto = new ConfPagamentoBean();
        $config = new ConfPagamentoInstance();

        $vendac_chave = $_GET["vendac_chave"];

        $vendac = $venda->c_busca_venda_por_chave($vendac_chave);

        $confpgto = $config->c_busca_confpag_por_vendac_chave($vendac_chave);

        $cliente = $cli->c_buscar_cliente_por_codigo($vendac->getVendac_cli_codigo());



        $DESCRICAO_PRODUTO = "REF" . $vendac->getVendac_chave();
        $VALOR_PRODUTO_SERVICO = str_replace(array(',', '.'), '', $confpgto->getConf_valor_parcela_gerencianet());

        // USADO PARA GRAVAR NO BOLETO MYSQL
        $VALOR_PARCELA = $confpgto->getConf_valor_parcela_gerencianet();

        $QUANTIDADE_ITENS = 1;
        $NOME_CLIENTE = $vendac->getVendac_cli_codigo() . " - " . $vendac->getVendac_cli_nome();
        $CPF_CLIENTE = str_replace(array('.', '-', ' '), '', $cliente->getCli_cpfcnpj());
        $TELEFONE = str_replace(array('.', '-', ' '), '', $cliente->getCli_contato());
        $EMAIL = $cliente->getCli_email();
        $VENCIMENTO_PRIM_PARCELA = $confpgto->getConf_vencimento_gerencianet();
        $PARCELAS = $confpgto->getConf_parcelas();
        $VENDAC_CHAVE = $vendac->getVendac_chave();

        $INSTRUCTIONS_1 = "Não cobrar após o vencimento.";
        $INSTRUCTIONS_2 = "O boleto será protestado em caso de inadimplencia";
        $INSTRUCTIONS_3 = "BOLETO REFERENTE A VENDA DE NUMERO : " . $vendac->getVendac_chave();
        $INSTRUCTIONS_4 = "XXXX";
        ?>	


        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../">
                        <img src="https://gerencianet.com.br/wp-content/themes/Gerencianet/images/marca-gerencianet.svg" onerror="this.onerror=null; this.src='images/marca-gerencianet.png'" alt="Gerencianet - Conceito em Pagamentos" width="218" height="31">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class=""><a href="#" target="_blank" title="Documentação Oficial da API Gerencianet">CursoAppVendas e API Gerencianet - gerando carnês da venda a prazo</a></li>
                    </ul>



                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>


        <form id="form" method="POST">
            <div class="col-lg-3">
                <h5>Informações do produto/serviço</h5>

                <input type="hidden" id="vendac_chave" value="<?= $VENDAC_CHAVE ?>" />
                <input type="hidden" id="quantidade" value="<?= $QUANTIDADE_ITENS ?>">
                <input type="hidden" id="valor_parcela" value="<?= $VALOR_PARCELA ?>">


                <div class="form-group">
                    <label for="exampleInputEmail1">Descrição do produto/serviço: (<em class="atributo">name</em>)<br><strong class="ex">Ex: Monitor LCD</strong></label>

                    <input required type="text" readonly value="<?= $DESCRICAO_PRODUTO ?>" class="form-control" id="descricao" placeholder="Descrição do produto">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Valor do produto/serviço: (<em class="atributo">value</em>)<br><strong class="ex">Ex: informar sem pontos ou vírgulas (5000 equivale a R$ 50,00) (int)</strong></label>
                    <input required type="text" readonly class="form-control" id="valor" value="<?= $VALOR_PRODUTO_SERVICO ?>"   placeholder="Valor do Produto">
                </div>


            </div>
            <div class="col-lg-3">
                <h5>Informações do cliente</h5>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nome do cliente: (<em class="atributo">name</em>) <br><strong class="ex">Ex: Gorbadoc Oldbuck</strong></label>
                    <input required type="text" readonly class="form-control" value="<?= $NOME_CLIENTE ?>" id="nome_cliente" placeholder="Nome do cliente">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">CPF: (<em class="atributo">cpf</em>) <br><strong class="ex">Ex: 94271564656 (sem formatação)</strong> </label>
                    <input required type="text" class="form-control" readonly id="cpf" value="<?= $CPF_CLIENTE ?>"  placeholder="CPF">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Telefone: (<em class="atributo">phone_number</em>)<br><strong class="ex">Ex: 5144916523 (sem formatação)</strong></label>
                    <input required type="text" class="form-control" readonly  id="telefone" value="<?= $TELEFONE ?>" placeholder="Telefone">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Email: (<em class="atributo">email</em>)<br><strong class="ex">Ex: email_cliente@servidor.com.br (string)</strong></label>
                    <input required type="email" class="form-control"  readonly id="email" value="<?= $EMAIL ?>" placeholder="Email">
                </div>

            </div>
            <div class="col-lg-3">
                <h5>Vencimento</h5>

                <div class="form-group">
                    <label for="exampleInputEmail1">Data de vencimento: (<em class="atributo">expire_at</em>) <br><strong class="ex">Ex: 2018-08-31 (yyyy-mm-dd)</strong></label>
                    <input required type="text" class="form-control"  id="vencimento" value="<?= $VENCIMENTO_PRIM_PARCELA ?>" placeholder="Data de vencimento">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Número de parcelas: (<em class="atributo">repeats</em>) <br><strong class="ex">Ex: 5 (int)</strong></label>
                    <input required type="text" class="form-control"  id="repeticoes" value="<?= $PARCELAS ?>" placeholder="Data de vencimento">

                </div>
            </div>
            <div class="col-lg-3">
                <h5>Instruções (opcional)</h5>
                <div class="form-group">
                    <label for="exampleInputEmail1">1<sup>a</sup> linha de instrução: (<em class="atributo">instructions</em>) <br><strong class="ex">Ex: String</strong></label>
                    <input required type="text" class="form-control" id="instrucao1"  value="<?= $INSTRUCTIONS_1 ?>" placeholder="Instrução 1">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">2<sup>a</sup> linha de instrução: (<em class="atributo">instructions</em>) <br><strong class="ex">Ex: String</strong></label>
                    <input required type="text" class="form-control" id="instrucao2" value="<?= $INSTRUCTIONS_2 ?>" placeholder="Instrução 2">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">3<sup>a</sup> linha de instrução: (<em class="atributo">instructions</em>) <br><strong class="ex">Ex: String</strong></label>
                    <input required type="text" class="form-control" id="instrucao3" value="<?= $INSTRUCTIONS_3 ?>" placeholder="Instrução 3">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">4<sup>a</sup> linha de instrução: (<em class="atributo">instructions</em>) <br><strong class="ex">Ex: String</strong></label>
                    <input required type="text" class="form-control" id="instrucao4" value="<?= $INSTRUCTIONS_4 ?>" placeholder="Instrução 4">
                </div>

            </div>
            <div class="col-lg-12">
                <button id="btn_emitir_boleto" type="button" class="btn btn-success">Emitir carnê <img src="../img/ok-mark.png"></button>
            </div>
        </form>




        <!-- Este componente é utilizando para exibir um alerta(modal) para o usuário aguardar as consultas via API.  -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Um momento.</h4>
                    </div>
                    <div class="modal-body">
                        Estamos processando a requisição <img src="../img/ajax-loader.gif">.
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Este componente é utilizando para exibir um alerta(modal) para o usuário aguardar as consultas via API.  -->
        <div class="modal fade" id="myModalResult" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Retorno da emissão do Carnê.</h4>
                    </div>
                    <div class="modal-body">

                        <!--div responsável por exibir o resultado da emissão do boleto-->
                        <div id="boleto" class="hide">
                            <div class="panel panel-success">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <strong>Dados do Carnê</strong>
                                        <table class="table table-bordered">
                                            <thead>

                                                <tr>
                                                    <th>Código da carnê</th>
                                                    <th>Status</th>
                                                    <th>Link</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th id="table_id_ass"></th>
                                                    <th id="table_status"></th>
                                                    <td id="table_link"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <strong>Valores</strong>

                                        <table class="table table-bordered">
                                            <thead>

                                                <tr>
                                                    <th>#</th>
                                                    <th>N° Parc.</th>
                                                    <th>Valor</th>
                                                    <th>Data. Exp.</th>
                                                    <th>Link</th>
                                                </tr>
                                            </thead>
                                            <tbody id="charges_tb">

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>