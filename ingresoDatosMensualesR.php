<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         include_once "conexion.php";
         $idCentro=$_POST['centro'];
            $idEmpresa=$_POST['empresa'];
          $mes=$_POST['mes'];
           $año=$_POST['año'];
             $cupos=$_POST['CantidadCupos'];
          
              
              
    $query="insert into CuposLimite values (null,$cupos,$idCentro,$idEmpresa,$mes,$año)";    
    $resultado=mysql_query($query);
    if($resultado) { 
    //success 
        echo"Agregado con exito, redireccionando";
        ?><meta http-equiv="Refresh" content="3;url=AgregarDatosMensualesR.php">;
        <?php
} else { 
    //failure
    echo " ya se agregaron datos para el mes o año seleccionado, redireccionando";
    ?>
        
    <meta http-equiv="Refresh" content="3;url=AgregarDatosMensualesR.php">;
    <?php
}        
    ?>
    </body>
</html>
