<!DOCTYPE html>

<html lang='es-CO'>
    <head>
        <meta http-equiv='content-type' content='application/xhtml+xml; charset=utf-8'/>
        <title>Préstamo Equipos</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <script>

            $(document).ready(
                function() {
                    $('.myselect').select2();
                }
            );
        </script>
    </head>

    <body>
        <?php
        error_reporting(-1);
        date_default_timezone_set('America/Bogota');
        session_start();
        
        include_once("controlador/controlador.php");
        $c_Login = new Controlador();
        ?>
    </body>
</html>
