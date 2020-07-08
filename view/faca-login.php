<!DOCTYPE html>
<html lang="pt_Br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>faca-login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Custom CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">
    </head>
    <body style="background-color: #ffffff">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Sessão Terminada - Faça login novamente</h3>
                    <?php
                    require_once './config.php';
                    ?>                    
                    <a class="btn btn-primary btn-xl" href="" onClick="window.open('<?php echo BASE_URL ?>');return false;" >Fazer login</a>
                </div>
            </div>
        </div>
    </body>
</html>