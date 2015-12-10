<?php
session_start ();
require_once dirname(__FILE__)."/header.php";
include_once dirname(__FILE__)."/Include/verificacionUsuario.php";
include_once dirname(__FILE__)."/querys/getEmpresa.php";
?>
<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body background="images/bg.gif">
	<div class="container">
		<h2>Agregar Centro Nuevo</h2>
	<?php //	<form action='querys/insertCentroNuevoR.php' method='POST'> ?>	
	
	
		<div id="respuesta"></div>
</body>
			<div class="form-group">
			<label for="nombre">Nombre</label> <input type="text"
				class="form-control" id="nombre" placeholder="Agrege nombre"
				required>
		</div>
		<div class="form-group">
			<label>Empresa a la que pertenece</label> <br>

          <?php
			$resultado = getEmpresa();
				if ($resultado) {
					echo "<select class='form-control' required name='empresa' id='empresa' >";
					echo "<option value=''> Seleccione Empresa </option>";
					foreach($resultado as $row){
						echo "<option value='" . $row ['idEmpresa'] . "'>" . $row ['Nombre'] . "</option>";
					}
					echo "</select>";
				// echo "</form>";
				}
			?>
    	</div>
		<div class="form-group">
			<label for="siglas">Siglas</label> <input type="text" class="form-control" id="siglas" placeholder="Agrege siglas" required>
		</div>
		<div class="form-group">
			<label for="Ecos">N&uacute;mero de ecos</label> <input type="number" class="form-control" id="ecos" placeholder="Agrege n&uacute;mero de ecos" required>

		</div>
		<div class="form-group">
			Modificar nombres y colores de Ecos (Eco1,Eco2... por Default) <br> <input type="checkbox" id="checkbox">
		</div>
		<div class="row">
			<div id="append" class="col-xs-6 container" style="display: none"></div>
			<!--	<div id="color" class="col-xs-2" style="display: none"></div> -->
		</div>
		<div class="form-group">
			<br> <input class='btn btn-info btnedit ' type='submit' value='Agregar'>
	</div>
</html>
<script>

	$( "#ecos" ).bind('keyup', function (event){
		event.preventDefault();


		$('#append').empty();
		var content = "<table class='table'><thead><tr><th>Nombre</th><th>Color</th></tr></thead><tbody>";
		var colores = new Array("#001AFF", "#FF0000", "#00FF00", "#FFF700", "#FF8D00","#00FFD5", "#FF04EF", "#006903", "#9E00FF", "#06FF7B");
		var a = 0;
	for( var i = 1 ; i<= $( "#ecos" ).val() ; i++){
		content += "<tr><td><input type='Text' class='form-control Eco'  Value='Eco"+ i +"' required></td>";
		content += " <td><input type='color' class='form-control Color' value='"+ colores[a] +"'></td></tr> ";
		a++;
		if(a === 9){
			a = 0;
			}
		}
		content += "</tbody></table>";
	$('#append').append(content);

	// $( ".Eco1" ).focus() ;

	  });

 </script>
<script>
$('#checkbox').on('click', function() {

	$('#append').toggle();

});
</script>
<script>
//ajax para guardado de datos
$(".btnedit").click(function(){

	var name= $('#nombre').val();
	var nombreEcos = [];
	$(".Eco").each(function(){
		nombreEcos.push($(this).val());
	});
	var colores =[];
	$(".Color").each(function(){
		colores.push($(this).val());
		});


	 jQuery.ajax({
	       method: "POST",
	       url: "querys/insertCentroNuevoR.php",
	       data: {
		     		'nombre':$('#nombre').val(),
		     		'empresa':$('#empresa').val(),
		     		'siglas':$('#siglas').val(),
		     		'ecos':$('#ecos').val(),
		     		'nombreEcos': nombreEcos,
		     		'coloresEcos': colores

	       },

	       error: function() {
	    	   alert("Error, intente nuevamente");
	       },

	       success: function(response)
	       {
	    	   $("#respuesta").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Exito!</strong> Se agreg&oacute; correctamente a: ' + name+ '.</div>');
		    	$('#nombre').val('');
	     		$('#empresa').val('');
	     		$('#ecos').val('');
	     		$('#siglas').val('');
	     		$('#append').empty();
	     		setTimeout(function(){location.reload()},1500)
			

	       }
	 });

});


</script>