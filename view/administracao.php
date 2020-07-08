<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once './config.php';
require_once '../util/Util.php';

if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

 error_reporting(E_ALL ^ E_NOTICE);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="img/cmdvic.png">

        <title>Aplicação de vendas</title>


        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">


        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">


        <!-- Custom Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->




    </head>

    <body style="background-color:#ffffff">

        <div id="wrapper">
            <?php
            include_once 'menu.php';
            ?>
            <div id="page-wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Curso AppVendas Administração Seja Bem vindos...</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-lg-12">
                        <br>
                        <iframe name="Frame1"  style="border:none" onscroll="auto" src="home.php" width="100%" height="1500px"></iframe> 
                    </div>
                </div>
            </div>

            <!-- jQuery -->
            <script src="js/jquery.min.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="js/bootstrap.min.js"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="js/metisMenu.min.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="js/sb-admin-2.js"></script>
    </body>
</html>