<?php

require_once '../../include/auto_load_path_2.php';
define('_MPDF_URI', '../libs/mpdf60/');
include '../libs/mpdf60/mpdf.php';
$mpdf = new mPDF();

//$vendac_cli_nome = $_POST["cli_nome"];
$data_inicial = $_POST["data_inicial"];
$data_final = $_POST["data_final"];

$nome = (isset($_POST["cli_nome"])) ? $_POST["cli_nome"] : ((isset($_POST["usu_nome"])) ? $_POST["usu_nome"] : 0 );


// pegando os dados e itens da venda
$vendac = new VendaCInstance();
$vendacBean = new VendaCBean();
$vendad = new VendaDInstance();
$vendadBean = new VendaDBean();

$clienteBean = new ClienteBean();
$cliente = new ClienteInstance();


if (isset($_POST["cli_nome"])) {
    $vendacBean = $vendac->c_buscar_vendas_por_nome_cliente(trim($nome), Util::format_data_AAAA_MM_DD($data_inicial), Util::format_data_AAAA_MM_DD($data_final));
    $str_cabecalho = "Relatório de vendas por clientes";
}

if (isset($_POST["usu_nome"])) {
    $vendacBean = $vendac->c_buscar_vendas_por_nome_vendedor(trim($nome), Util::format_data_AAAA_MM_DD($data_inicial), Util::format_data_AAAA_MM_DD($data_final));
    $str_cabecalho = "Relatório de vendas por vendedor";
}

if (isset($_POST["periodo"])) {
    $vendacBean = $vendac->c_buscar_vendas_por_periodo(Util::format_data_AAAA_MM_DD($data_inicial), Util::format_data_AAAA_MM_DD($data_final));
    $str_cabecalho = "Relatório de vendas por período";
}

if (!isset($_POST["imprime_itens"])) {

    $cabecalho = 'Emissão : {DATE d/m/y}   ** ' . $str_cabecalho . '  ** {PAGENO} de {nbpg} paginas';


    $html.='<br>';
    $html.='<br>';
    $html .= '<img src="../logo.png" width="80px" heigth="80px" alt="logo">';

    $html .='<br>';
    $html .='<br>';

    $html .='<table border="1" class="tabela" cellspacing="2"   cellpadding="2">';
    $html .='<thead>
                <tr>
                    <th align=center class="titulos">Pedido</th>
                    <th align=center class="titulos">Data</th>
                    <th align=center class="titulos">Cliente</th>
                    <th align=center class="titulos">Entrega</th> 
                    <th align=right class="titulos">Total</th>                                        
                </tr>
         </thead>';


    $tot = 0;
    foreach ($vendacBean as $venda) {

        $html .='<tbody>';
        $html .= '<tr>';
        $html .= '<td align=left class="linhas_itens">' . $venda->getVendac_chave() . '</td>';
        $html .= '<td align=center class="linhas_itens">' . $venda->getVendac_datahoravenda() . '</td>';
        $html .= '<td align=left class="linhas_itens">' . $venda->getVendac_cli_nome() . '</td>';
        $html .= '<td align=center class="linhas_itens">' . $venda->getVendac_previsaoentrega() . '</td>';
        $html .= '<td align=center class="linhas_itens">' . $venda->getVendac_valor() . '</td>';
        $html .= '</tr>';
        $html .='</tbody>';
        $tot += $venda->getVendac_valor();
    }

    $html .= '<tr>';
    $html .= '<td align=right colspan="4" class="subtotal">SUBTOTAL </td>';
    $html .= '<td align=left class="subtotal">' . number_format($tot, 2, ',', ' ') . '</td>';
    $html .= '</tr>';

    $html .='</table>';
} else {

    foreach ($vendacBean as $venda) {

        $cabecalho = 'Emissão : {DATE d/m/y}   ** ' . $str_cabecalho . '  ** {PAGENO} de {nbpg} paginas';
        $html.='<br>';
        $html.='<br>';
        $html .= '<img src="../logo.png" width="80px" heigth="80px" alt="logo">';

        $html .='<br>';
        $html .='<br>';

        $html .='<span class="pedido"> Número do Pedido.:  ' . $venda->getVendac_chave() . '  <br/>';
        $html .='<span class="pedido">Data Venda.: ' . $venda->getVendac_datahoravenda() . '   <br>';
        $html .='<span class="pedido">Data Entrega.: ' . $venda->getVendac_previsaoentrega() . ' <br>';
        $html .='<span class="pedido">Cliente.: ' . $venda->getVendac_cli_codigo() . ' - ' . $venda->getVendac_cli_nome() . '  <br>';
        $html .='<span class="pedido">Endereço.: ' . $clienteBean->getCli_endereco() . '  <br>';
        $html .='<span class="pedido">Vendedor.: ' . $venda->getVendac_usu_codigo() . '- ' . $venda->getVendac_usu_nome() . '  <br>';

        $html .='<br>';
        $html .='<br>';

        $html .='<table border="1" class="tabela" cellspacing="2"   cellpadding="2">';
        $html .='<thead>
                <tr>
                    <th align=center class="titulos">Item</th>
                    <th align=center class="titulos">CodigoBarras</th>
                    <th align=center class="titulos">CódProduto</th>
                    <th align=center class="titulos">Descric. Produto</th>
                    <th align=center class="titulos">Quant.</th>
                    <th align=center class="titulos">Unit.</th>
                    <th align=right class="titulos">Total</th>                                        
                </tr>
         </thead>';


        $tot = 0;
        $vendadBean = $vendad->c_busca_itens_da_venda($venda->getVendac_chave());
        foreach ($vendadBean as $itens) {

            $html .='<tbody>';
            $html .= '<tr>';
            $html .= '<td align=center class="linhas_itens">' . $itens->getVendad_nro_item() . '</td>';
            $html .= '<td align=left class="linhas_itens">' . $itens->getVendad_ean() . '</td>';
            $html .= '<td align=center class="linhas_itens">' . $itens->getVendad_prd_codigo() . '</td>';
            $html .= '<td align=left class="linhas_itens">' . $itens->getVendad_prd_descricao() . '</td>';
            $html .= '<td align=center class="linhas_itens">' . $itens->getVendad_quantidade() . '</td>';
            $html .= '<td align=left class="linhas_itens">' . $itens->getVendad_preco_venda() . '</td>';
            $html .= '<td align=right class="linhas_itens">' . $itens->getVendad_total() . '</td>';
            $html .= '</tr>';
            $tot += $itens->getVendad_total();
            $html .='</tbody>';
        }

        $html .= '<tr>';
        $html .= '<td align=right colspan="6" class="subtotal">SUBTOTAL</td>';
        $html .= '<td align=left class="subtotal">' . number_format($tot, 2, ',', ' ') . '</td>';
        $html .= '</tr>';


        $html .='</table>';
        $html.= '<pagebreak />';
    }
}



$mpdf->SetDisplayMode('fullwidth');
$styleSheet = file_get_contents('../css/estilo_impressao.css');
$mpdf->SetHeader($cabecalho);
$mpdf->WriteHTML($styleSheet, 1);
$mpdf->WriteHTML($html);
$mpdf->Output('../pedidos_pdf/' . $chave_da_venda . '.pdf');
$mpdf->Output();
exit();






