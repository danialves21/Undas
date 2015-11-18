<?php
session_start();
require_once dirname(__FILE__)."/header.php";
include_once dirname(__FILE__)."/Include/verificacionUsuario.php";
?>
<html>
   <head>
       <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    </head>
    <body background="images/bg.gif">
         <div class="container">
      <h2>Reporte de Errores</h2>
	<div >
<p id='respuesta'>
</p>
</div>
		<div class="form-group">
          <input type="hidden" class="form-control" id="idsession" value='<?php echo $_SESSION['idusuario'];?>' disabled>
        </div>
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" value='<?php echo $_SESSION['usuario'];?>' disabled>
        </div>
           <div class="form-group">
          <label for="nombre">Titulo</label>
          <input type="text" class="form-control" id="titulo" placeholder="Ingrese un titulo para el error" required>
        </div>
           <div class="form-group">
          <label for="nombre">Descripcion</label>
          <textarea name="descripcion" cols="40" rows="5" id="descripcion" class="form-control"></textarea>
        </div>
        
             <input type="submit" value="Agregar" id='agregar' class='btn btn-info btnedit'/>
	
    </div>

    </body>
</html>

<script>
$("#agregar").click(function(){

	var name= $('#nombre').val();

			 jQuery.ajax({
			       method: "POST",
			       url: "querys/insertBug.php",
			       data: {
				     		'id':$('#idsession').val(),
				     		'titulo':$('#titulo').val(),
				     		'descripcion':$('#descripcion').val()				     		
			       },

			       error: function() {
			    	   alert("Error al enviar el reporte, contactese con su tecnico");
			       },

			       success: function(response)
			       {
			    	   $("#respuesta").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Exito!</strong> Se agreg&oacute; correctamente su Error.</div>');
			    	    $('#idsession').val('');
			     		$('#titulo').val('');
			     		$('#descripcion').val('');
			       }
			 });

});
</script>