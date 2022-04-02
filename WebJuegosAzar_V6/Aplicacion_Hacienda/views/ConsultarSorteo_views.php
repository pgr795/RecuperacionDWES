<?php
if(!isset($_SESSION['id']) && !isset($_SESSION['usuario'])){
		header("Location:../index.php");
		unset($_SESSION['id']);
		unset($_SESSION['usuario']);
		session_destroy();
}
?>

<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../views/css/bootstrap.min.css">
	<title>Consultar Sorteo</title>
</head>
<body>
	<div class="card-header"><h2>Consultar Sorteo</h2></div>
		<div class="card-body">

		<B>Bienvenido/a:</B><?php echo $_SESSION['usuario']; ?> <BR><BR>
		<B>Identificador Empleado:</B><?php echo $_SESSION['id']; ?>  <BR>
		
	
	<form method="post" action="ConsultarSorteo_controllers.php">
			<p>
			<?php
				$sorteos=sorteos($_SESSION['id']);
				mostrarSorteos($sorteos);
			?>
			</p>
			<input type='submit' name='accion' value='Consultar Sorteos' class="btn btn-warning disabled"/>
			<input type='submit' name='accion' value='Atras' class="btn btn-warning disabled"/>
			<?php
				function mostrarInformacion($conexion,$datos){
				echo "<table border=1px>";
				echo "<tr>";
				echo "<td> NSORTEO </td>";
				echo "<td> FECHA </td>";
				echo "<td> RECAUDACION </td>";
				echo "<td> RECAUDACION_PREMIOS </td>";
				echo "<td> DNI </td>";
				echo "<td> ACTIVO </td>";
				echo "<td> COMBINACION_GANADORA </td>";
				echo "</tr>";
				echo "<tr>";
					foreach($datos as $consulta){
						echo "<td>".$consulta."</td>";
					}
				echo "</tr>";
				echo "</table>";
			}
			?>
	</form>
</body>
</html>	
