<?php
include_once dirname(__FILE__) . "/querys/getTM.php"; // aqui ya se incluye la conexion local
include_once dirname(__FILE__) . "/querys/getEcos.php";
include_once dirname(__FILE__) . "/querys/getEventos.php";
include_once dirname(__FILE__) . "/querys/getCentrosGroup.php";
include_once dirname(__FILE__) . "/querys/getPrestaciones.php";

if ($_SESSION ["usuario"]) {

} else {
    //print_r($_SESSION);
    //si no hay sesion se envi al login
    header('Location:logIn.php');
}
?>
<head>
    <!-- title and meta -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TMTECNOMED APP</title>

    <script src="Include/jquery-2.1.4.min.js"></script>
    <script src="Include/bootstrap.js"></script>
    <script src="Include/jquery-ui.js"></script>
    <script src='calendario/lib/moment.min.js'></script>
    <script src='calendario/lib/jquery-ui.custom.min.js'></script>
    <script src='calendario/fullcalendar.min.js'></script>
    <script src='calendario/lang/es.js'></script>
    <script src='chart-master/Chart.js'></script>

    <!-- favico-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">


    <!-- css -->

    <link href='//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css' rel='stylesheet'>
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <link href='calendario/fullcalendar.css' rel='stylesheet'/>
    <link href='calendario/fullcalendar.print.css' rel='stylesheet' media='print' />
    <link href='css/style.css' rel='stylesheet'>

</head>
<body background="images/bg.gif">
    <div class='row' align="left">
        <img src="images/logo.gif" alt="logo" />
    </div>
    <nav class="navbar navbar-default ">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse"
                 id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php
                    // MENU HORARIOS

                    echo '<li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" role="button">Agenda<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu"><!-- empresas -->
                    <!-- <li class="dropdown-submenu">
                        <a tabindex="-1" href="#">More options</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" tabindex="-1">Second level link</a></li>
                            <li><a href="#" tabindex="-1">Second level link</a></li>
                            <li><a href="#" tabindex="-1">Second level link</a></li>
                            <li><a href="#" tabindex="-1">Second level link</a></li>
                            <li><a href="#" tabindex="-1">Second level link</a></li>
                        </ul>
                    </li> -->
                        ';
                    foreach (getCentrosGroup($_SESSION ["usuario"]) as $empresa => $centros) {
                        echo '<li class="dropdown-submenu  disabled"><a href="#" tabindex="-1">' . $empresa . '</a><!-- $empresa  -->
                            <ul class="dropdown-menu"><!-- menu $empresa -->
                                    ';
                        foreach ($centros as $centro) {
                            foreach ($centro as $datosCentro) {
                                //echo $datosCentro['Nombre'] . '<br>';
                                echo '<li><a href="informacionHorario.php?idCentro=' . $datosCentro['idCentro'] . '&centro=' . $datosCentro['Nombre'] . '(' . $datosCentro['Siglas'] . ')" tabindex="-1">' . $datosCentro['Nombre'] . ' <b>(' . $datosCentro['Siglas'] . ')</b></a></li>
                                        ';
                            }
                        }
                        echo '</ul><!-- menu $empresa-->
                                  </li><!-- dropdown-submenu -->
                                  ';
                    }
                    echo '</ul><!-- empresas -->
                          </li><!-- menu horarios-->
                          ';
                    /* while ($row = mysql_fetch_array($result)) {
                      echo "<li><a href='calendario.php?idCentro=" . $row['idCentro'] . "'>" . $row['Nombre'] . "</a></li>\n";
                      }
                      echo "</ul>\n</li>\n <!-- Dropdown honorarios -->\n";
                     */
                    // si es admin ve esto
                    //MENU EMPRESAS
                    ?></ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="editarClave.php">Editar Clave</a></li>
                    <li><button onClick="window.location.href = 'logOff.php'" class="btn btn-danger navbar-btn"><strong class="NombreEmpresa" idEmpresa="<?php echo $_SESSION ["idusuario"];?>"><?php echo $_SESSION['usuario']; ?></strong> (Cerrar sesión)</button></li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>