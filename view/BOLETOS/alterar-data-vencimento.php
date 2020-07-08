<?php
require_once '../../Util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Alterar vencimento</title>

        <link rel="stylesheet" href="../css/bootstrap.css">       
        <script type="text/javascript" src="../js/bootstrap.js"></script>



        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <form  name="form" class="form-control" id="form_categoria" action="alterar-vencimento.php" method="POST">

            <div class="col-lg-6">
                <label class="control-label"  for="inputWarning1">Carne</label>
                <input type="text" class="form-control" name="carnet_id" value="<?php echo $_GET['carnet_id'] ?>" />
            </div>
            <div class="col-lg-6">
                <label class="control-label"  for="inputWarning1">Parcela</label>
                <input  type="text" class="form-control" name="parcel" value="<?php echo $_GET['parcel'] ?>" />
            </div>
            <div class="col-lg-6">
                <label class="control-label"  for="inputWarning1">Vencimento</label>
                <input type="date" class="form-control" name="data_vencimento" />
            </div>
            <br>
            <br>
            <div class="col-lg-6">
                <input  class="btn btn-primary" type="submit" value="enviar" />
            </div>
        </form>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

