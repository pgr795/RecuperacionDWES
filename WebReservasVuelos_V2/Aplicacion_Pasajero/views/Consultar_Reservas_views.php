<?php
	if(!isset($_SESSION['email']) && !isset($_SESSION['nombre']) && !isset($_SESSION['id'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['nombre']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
		header("Location:../index.php");
	}
?>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../views/css/bootstrap.min.css">
	<title>CONSULTAR RESERVA</title>
</head>
<body>
	  <div class="container ">
		<h1>PORTAL DE RESERVA VUELOS</h1> 
		<br>
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Pasajero - CONSULTAR RESERVA </div>
		<div class="card-body">
		
		<B>Bienvenido/a: </B><?php echo $_SESSION['nombre']; ?> <BR><BR>
		<B>Identificador Pasajero: </B><?php echo $_SESSION['email']; ?>  <BR><BR>
		
       <!--Formulario con botones -->
	<form method="post" action="">
			
			<?php
				//$sorteos=sorteos($_SESSION['id']);
				//mostrarSorteos($sorteos);
			?>
	
			<?php
				// function mostrarInformacion($conexion,$datos){
				// echo "<table border=1px>";
				// echo "<tr>";
				// echo "<td> NAPUESTA </td>";
				// echo "<td> DNI </td>";
				// echo "<td> NSORTEO </td>";
				// echo "<td> FECHA </td>";
				// echo "<td> N1 </td>";
				// echo "<td> N2 </td>";
				// echo "<td> N3 </td>";
				// echo "<td> N4 </td>";
				// echo "<td> N5 </td>";
				// echo "<td> N6 </td>";
				// echo "<td> C </td>";
				// echo "<td> R </td>";
				// echo "<td> IMPORTE_PREMIO </td>";
				// echo "<td> CATEGORIA_PREMIO </td>";
				// echo "</tr>";
	
					// foreach($datos as $indice => $consulta){
						// echo "<tr>";
						// foreach($consulta as $indice2 => $datos){
						// echo "<td>".$datos."</td>";
						// }
						// echo "</tr>";
					// }		
					// echo "</table>";
				// }
			?>
				<input type='submit' name='accion' value='Consultar Reserva' class="btn btn-warning disabled"/>
				<input type="button" value="Atras" onclick="window.location.href='../controllers/Menu_Pasajero_controllers.php'" class="btn btn-warning disabled">
		</div>
			
	</form>
</body>
</html>	
