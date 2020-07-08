<!DOCTYPE html>
<html lang="pt_Br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title></title>
        <?php
        include_once './obter_css.php';
        ?>
    </head>
    <body style="background-color: #ffffff">
        <div class="container" >
            <div class="row">
                <div class="jumbotron">
                    <h3>Curso AppVendas com Android Studio e PHP</h3>
                     <?php
                    $path = "pedidos_pdf/";
                    $diretorio = dir($path);

                    while ($arquivo = $diretorio->read()) {

                        if ($arquivo != "." && $arquivo != "..") {
                            
                            
                            $pedido = explode(".",$arquivo);
                            
                            echo "<a  href='" . $path . $arquivo . "'>" . ' <i class="fa fa-file-pdf-o fa-2x"></i>' . ' Pedido : ' . $arquivo . "</a><br />";
                        
                            
                            
                        }
                    }
                    $diretorio->close();
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>