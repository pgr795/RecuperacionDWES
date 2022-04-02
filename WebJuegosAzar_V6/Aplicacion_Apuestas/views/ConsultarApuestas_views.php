<?php
	if(!isset($_SESSION['id']) || !isset($_SESSION['usuario'])){
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
	<title>Consultar Apuestas</title>
</head>
<body>
	<div class="card-header"><h2>Consultar Apuestas</h2></div>
		<div class="card-body">

		<B>Bienvenido/a:</B><?php echo $_SESSION['usuario']; ?> <BR><BR>
		<B>Identificador Apostador:</B><?php echo $_SESSION['id']; ?>  <BR>
		
	
	<form method="post" action="ConsultarApuestas_controllers.php">
			<p>
			<?php
				$sorteos=sorteos($_SESSION['id']);
				mostrarSorteos($sorteos);
			?>
			</p>
			<input type='submit' name='accion' value='Consultar Apuestas' class="btn btn-warning disabled"/>
			<input type='submit' name='accion' value='Atras' class="btn btn-warning disabled"/>
			<?php
				function mostrarInformacion($conexion,$datos){
				echo "<table border=1px>";
				echo "<tr>";
				echo "<td> NAPUESTA </td>";
				echo "<td> DNI </td>";
				echo "<td> NSORTEO </td>";
				echo "<td> FECHA </td>";
				echo "<td> N1 </td>";
				echo "<td> N2 </td>";
				echo "<td> N3 </td>";
				echo "<td> N4 </td>";
				echo "<td> N5 </td>";
				echo "<td> N6 </td>";
				echo "<td> C </td>";
				echo "<td> R </td>";
				echo "<td> IMPORTE_PREMIO </td>";
				echo "<td> CATEGORIA_PREMIO </td>";
				echo "</tr>";
	
					foreach($datos as $indice => $consulta){
						echo "<tr>";
						foreach($consulta as $indice2 => $datos){
									echo "<td>".$datos."</td>";
						}
						echo "</tr>";
					}		
					echo "</table>";
				}
			?>
	</form>
</body>
</html>	
