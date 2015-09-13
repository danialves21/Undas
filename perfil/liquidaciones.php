<?php
include_once "../Include/isAdmin.php";
include_once "../Include/meses.php";
include_once "../querys/getHoras.php";
include_once "../querys/getValorHora.php";

$mes = $_POST['mes'];
$rut = $_POST['rut'];

$Horas = getHoras($rut, $mes);
echo "<table id='t01' class='table table-hover table-bordered table-condensed table-responsive' style='max-width:80%; white-space: nowrap'>";
echo "<thead><tr class='bg-primary' colspan='2'>";
echo "<th>Fecha: ";
echo Mes($Horas[0]['Mes']);
echo " " . $Horas[0]['Year'];
echo " </th>";
echo "</thead></tr>";

echo "<thead><tr class='bg-primary' colspan='2'>";
echo "<th>TM: ";
echo $Horas[0]['TMNombre'];
echo " " . $Horas[0]['TMApellido'];
echo " </th>";
echo "</thead></tr>";

echo "<thead><tr class='bg-info'>";
echo "<th>Empresa</th>";
echo "<th>Horas Realizadas</th>";
echo "</thead></tr><tbody>";
if($Horas){
foreach ($Horas as $informacion) {
    ?>


    <tr>
        <td>

            <span class="CentroHoraRealizada"><?php echo $informacion['NombreEmpresa']; ?></span>

        </td>
        <td>
            <span class='label label-info' ><span  class="HorasRealizadas"><?php echo number_format($informacion['Horas'], 2); ?></span> horas </span>

        </td>
    </tr>
    <?php
}}
else 
{
	echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Tm no tiene Horas realizadas asociadas.
</div>';
}
?>
</tbody>

<?php
echo "<thead><tr class='bg-info'>";
echo "<th>Empresa</th>";
echo "<th>Valor Hora</th>";
echo "</thead></tr><tbody>";
$ValorHoras = getValorHora($rut);
if($ValorHoras){
	

foreach ($ValorHoras as $valores) {
    ?>
    <tr>

        <td>

            <span class="CentroValorHora"><?php
            echo "<span class='nombreEmpresa' >";
                echo $valores['Empresa'];
                echo "</span>";
                echo " ";
                echo "<span class='semana'>";
                if ($valores['Semana'] == 1) {
                    echo 'Semana';
                } else {
                    echo 'Sabado';
                }
                echo "</span>";
                ?> </span>

        </td>

        <td>

            <span  class='label label-success'>$ <span class='Valor' ><?php echo $valores['Valor']; ?></span></span>

        </td>


    </tr>

    <?php
}}
else 
{
	echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> TM no tiene Valores Horas asociados.
</div>';
}
?>
</tbody>
<?php
echo "<thead><tr class='bg-success' colspan='2'>";
echo "<th>Valor Honorarios Base: $ <span id='totalHonorarios'></span></th>";
echo "<th>Total Horas Mes: <span id='totalHoras'></span></th>";
echo "</tr>";
echo "<tr><th class='bg-info' colspan='2'><center>Boleta de Honorarios <center></th></tr>";
echo "<tr><th class='bg-warning' colspan='2'>Total Bruto: $ <span id='bruto'></span></th></tr>";
echo "<tr><th class='bg-warning' colspan='2'>10% de retencion: $ <span id='retencion'></span></th></tr>";
echo "<tr><th class='bg-warning' colspan='2'>Total liquido honorarios: $ <span id='liquido'></span></th></tr>";
echo "</thead>";
?>

</table>


<script>
    var suma = 0;
    $(".HorasRealizadas").each(function(index) {
        suma += parseFloat($(this).text());
    });
    $('#totalHoras').html(suma);
</script>

<script>
var contador = 0;
$(".CentroHoraRealizada").each(function() {
 var horasRealizadas= $(this).text();
 var horas = $(this).parent().parent().find('.HorasRealizadas').text(); 
 //alert(horas);
 //alert(horasRealizadas);
 $(".nombreEmpresa").each(function() {
	var centroValorHora = $(this).text();
    var valorhora= $(this).parent().parent().parent().find('.Valor').html();
   // alert(valorhora);
	//alert(centroValorHora);
if(horasRealizadas == centroValorHora)
{
	contador= (contador + parseFloat(horas*valorhora));
}
	
 });
});
$('#totalHonorarios').html(contador);
</script>
<script>
var bruto = $('#totalHonorarios').text();
$('#bruto').html(bruto);
var retencion = bruto*0.1;
$('#retencion').html(retencion);
var liquido = parseFloat(bruto)+parseFloat(retencion);
$('#liquido').html(liquido);
</script>