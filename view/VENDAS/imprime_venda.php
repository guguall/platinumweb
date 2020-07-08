<?php
require_once '../../Util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}
require_once '../../include/auto_load_path_2.php';

define('_MPDF_URI', '../libs/mpdf60/');
include '../libs/mpdf60/mpdf.php';
$mpdf = new mPDF();
//$mpdf->debug = true;
// parametro da venda enviado na url
$chave_da_venda = $_GET["chave"];
$cli_codigo = $_GET["cli_codigo"];

// pegando os dados e itens da venda
$vendac = new VendaCInstance();
$vendacBean = new VendaCBean();
$vendad = new VendaDInstance();
$vendadBean = new VendaDBean();

$clienteBean = new ClienteBean();
$cliente = new ClienteInstance();

$clienteBean = $cliente->c_buscar_cliente_por_codigo($cli_codigo);
$vendacBean = $vendac->c_busca_venda_por_chave($chave_da_venda);
$vendadBean = $vendad->c_busca_itens_da_venda($chave_da_venda);


$cabecalho = 'Emissão : {DATE d/m/y}   ** IMPRESSÃO DE PEDIDO  ** {PAGENO} de {nbpg} paginas';
$html .= '<br>';
$html .= '<br>';
$html .= '<img src="../logo.png" width="80px" heigth="80px" alt="logo">';

$html .= '<br>';
$html .= '<br>';

$html .= '<span class="pedido"> Número do Pedido.:  ' . $vendacBean->getVendac_chave() . '  <br/>';
$html .= '<span class="pedido">Data Venda.: ' . $vendacBean->getVendac_datahoravenda() . '   <br>';
$html .= '<span class="pedido">Data Entrega.: ' . $vendacBean->getVendac_previsaoentrega() . ' <br>';
$html .= '<span class="pedido">Cliente.: ' . $vendacBean->getVendac_cli_codigo() . ' - ' . $vendacBean->getVendac_cli_nome() . '  <br>';
$html .= '<span class="pedido">Endereço.: ' . $clienteBean->getCli_endereco() . '  <br>';
$html .= '<span class="pedido">Vendedor.: ' . $vendacBean->getVendac_usu_codigo() . '- ' . $vendacBean->getVendac_usu_nome() . '  <br>';

$html .= '<br>';
$html .= '<br>';


$html .= '<table class="tabela" cellspacing="2"  cellpadding="2">';


$html .= '<thead>
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


$html .= '<tbody>';


$tot = 0;
foreach ($vendadBean as $itens) {

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
}

$html .= '<tr>';
$html .= '<td align=right colspan="6" class="subtotal">SUBTOTAL</td>';
$html .= '<td align=left class="subtotal">' . number_format($tot, 2, ',', ' ') . '</td>';
$html .= '</tr>';

$html .= '</tbody>';

$html .= '</table>';


$mpdf->SetDisplayMode('fullwidth');
$styleSheet = file_get_contents('../css/estilo_impressao.css');
$mpdf->SetHeader($cabecalho);
$mpdf->WriteHTML($styleSheet, 1);
$mpdf->WriteHTML($html);

$mpdf->Output('../pedidos_pdf/' . $chave_da_venda . '.pdf');
$mpdf->Output();


exit();

