<?php
include_once "../conexionLocal.php";


$rut=$_POST['rut'];


<<<<<<< HEAD
$query="Delete from Empresa WHERE Rut='$rut'";
=======
$query="DELETE FROM Empresa WHERE Rut=$rut";
>>>>>>> origin/master

$resultado=mysql_query($query);
if($resultado) {
	//success
	echo"Borrado con exito";
	
} else { 
    //failure
    echo "Error en la eliminacion";
   
}   

