<?php
require_once '../../Util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>

        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">



        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <style>

            #resultado{
                display: none;
                width: 100%;
                display: absolute;   
                border-bottom: 1px solid #CFD8DC; 
                border-right:1px solid  #CFD8DC; 
                border-left:1px solid  #CFD8DC;  
                border-top: 1px solid  #CFD8DC;                
                font-weight: bold;
            }

            #resultado .item{
                padding-left: 95px;
                font-family: Helvetica;
                border-bottom: 1px solid  #CFD8DC;               
            }

            #resultado item:last-child{
                border-bottom: 0px;                
            }


            #resultado item:hover{
                background-color: #f2f2f2;
                cursor: pointer;
            }



        </style>

    </head>
    <body>  

        <div class="container">          
            <div class="row">
                <h2>Relatórios de vendas por vendedores</h2>
                <form method="POST" autocomplete="off" action="relatorios_generico.php" >


                    <div class="col-xs-12  col-md-10 col-lg-10  col-sm-12">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-print"></i></button>

                            </span>
                            <input type="text" required class="form-control" id="usu_nome" name="usu_nome"  placeholder="Pesquise o vendedor pelo nome">
                        </div><!-- /input-group -->
                        <div id="resultado"></div>

                    </div><!-- /.col-lg-6 -->


                    <div class="col-xs-12  col-md-6 col-lg-6  col-sm-12">
                        <label class="control-label">Data Inicial</label>
                        <input required id="data_inicial"   name="data_inicial"     type="text" class="form-control" placeholder="data inicial">

                    </div>


                    <div class="col-xs-12  col-md-6 col-lg-6 col-sm-12">
                        <label class="control-label">Data final</label>
                        <input required id="data_final"  name="data_final" type="text" class="form-control" placeholder="data final">

                    </div>                    
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>                    
                 
                    
                    <div class="col-xs-12  col-md-12 col-lg-12  col-sm-12">                        
                            <label class="btn btn-primary active">
                                <input type="checkbox" name="imprime_itens" > Imprimir itens da venda
                            </label>                       
                    </div>


                </form>
            </div><!-- /.row -->
        </div>



        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/auto_complete_vendedor.js"></script>
        <script src="../js/bootstrap-datepicker.min.js"></script>
        <script src="../js/bootstrap-datepicker.pt-BR.min.js"></script>

        <script>
            $('#data_inicial').datepicker({
                format: "dd/mm/yyyy",
                language: "pt-BR",
                orientation: "top right",
                autoclose: true,
                todayHighlight: true
            });

            $('#data_final').datepicker({
                format: "dd/mm/yyyy",
                language: "pt-BR",
                orientation: "top right",
                autoclose: true,
                todayHighlight: true
            });

        </script>



    </body>
</html>