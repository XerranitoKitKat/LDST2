<?php
#Obtenemos el dia, el mes y el año
$month=date("n");
$year=date("Y");
$diaActual=date("j");

$diaSemana=date("w",mktime(0,0,0,$month,1,$year));
# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<style>
		#calendar {
			font-family:helvetica;
			font-size:12px;
		}
		#calendar caption {
			text-align:left;
			padding:5px 10px;
			background-color:#003366;
			color:#fff;
			font-weight:bold;
		}
		#calendar th {
			background-color:#006699;
			color:#fff;
			width:40px;
		}
		#calendar td {
			text-align:right;
			padding:2px 5px;
			background-color:silver;
		}
		#calendar .primerTest{
			background-color:yellow;
		}
		#calendar .segundoTest{
			background-color:red;
		}
		#calendar .desconfinamiento{
			background-color:green;
		}
	</style>
</head>

<body>
<table id="calendar">
	<caption><?php echo $meses[$month]." ".$year?></caption>
	<tr>
		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
		<th>Vie</th><th>Sab</th><th>Dom</th>
	</tr>
	<tr bgcolor="silver">
		<?php
		$fin=$diaSemana+$ultimoDiaMes;
		for($i=1;$i<=35;$i++)
		{
			if($i==$diaSemana)
			{
				$day=1; #para que empiece el primer dia del mes
			}
			if($i<$diaSemana || $i>=$fin)
			{
				echo "<td>&nbsp;</td>"; # Mostramos celdas vacias en caso de que el mes no acabe en domingo o no empiece en lunes
			}else{

				if($day==$diaActual){
					echo "<td class='primerTest'>$day</td>";
					}
				else if($day==($diaActual + 10)){
					echo "<td class='segundoTest'>$day</td>";
					}
				else if($day==($diaActual + 15)){
					echo "<td class='desconfinamiento'>$day</td>";
					}
				else if($day!=$diaActual){
					echo "<td>$day</td>";
				}
				$day++;
			}
			# cuando llega al final de la semana, iniciamos una columna nueva
			if($i%7==0)
			{
				echo "</tr><tr>\n";
			}
		}
	?>
	</tr>
</table>
</body>
</html>
