
<?php
include_once "../conexionLocal.php";
$nombre = trim($_POST ['nombre']);
$apellido = trim($_POST ['apellido']);
$rut = trim($_POST ['rut']);
$mail = trim($_POST ['mail']);
$cuenta = trim($_POST ['cuenta']);
$banco = trim($_POST ['banco']);
$celular = trim($_POST ['celular']);
$comentario = trim($_POST ['comentario']);
$segundonombre = trim($_POST ['segundonombre']);
$segundoapellido = trim($_POST ['segundoapellido']);
$random=rand(1000000,9999999);
$contrasena=$apellido.$random;
	
	$query = "insert into tm values (null,'$nombre','$apellido','$rut','$mail',$celular,'$contrasena',0,'$cuenta','$banco',0,'$comentario', '$segundonombre', '$segundoapellido')";
	$resultado2 = mysql_query ( $query );
	if ($resultado2) {
		echo "Perfecto, redireccionando";
		$to = $mail;
		$subject = "Contraseña TMTECNOMED";
		$txt = "Su contraseña es: <strong>$contrasena</strong><br>Dirigase a <a href='http://app.tmtecnomed.cl'>app.tmtecnomed.cl<a> para acceder al sitio.<br><br><img";
		$headers = "From: serviciotenico@tmtecnomed.cl" . "\r\n";
		
		mail($to,$subject,$txt,$headers);
	}
	else {
		echo "error en la creacion";
	}
	