
<?php
include_once "../conexionLocal.php";
$nombre = $_POST ['nombre'];
$apellido = $_POST ['apellido'];
$rut = $_POST ['rut'];
$mail = $_POST ['mail'];
$celular = $_POST ['celular'];
$contrase�a = $_POST ['contrasena'];
$repetircontrase�a = $_POST ['repetircontrasena'];

if ($contrase�a == $repetircontrase�a) {
	// comprobamos si ha ocurrido un error.
	$query = "insert into TM values (null,'$nombre','$apellido','$rut','$mail','$celular','$contrase�a',0)";
	$resultado2 = mysql_query ( $query );
	if ($resultado2) {
		echo "Perfecto, redireccionando";
		?>

<meta http-equiv="Refresh" content="1;url=../agregarTmR.php">
<?php
	} else {
		echo "Error el rut ya existe, intente denuevo";
		?>

<meta http-equiv="Refresh" content="1;url=../agregarTmR.php">
<?php
	}
} else {
	echo " Las contrase�as no coinciden, redireccionando";
	?>
<meta http-equiv="Refresh" content="1;url=../agregarTmR.php">
; 
    <?php
}

?>
    