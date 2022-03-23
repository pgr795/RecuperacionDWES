<?php
	// if(!isset($_SESSION['id']) && !isset($_SESSION['usuario'])){
		// header("Location:../index.php");
		// unset($_SESSION['id']);
		// unset($_SESSION['usuario']);
		// session_destroy();
	// }
?>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../views/css/bootstrap.min.css">
	<title>Realizar Apuesta</title>
</head>
<body>
	<div class="card-header"><h2>Realizar Apuesta</h2></div>
		<div class="card-body">

		<B>Bienvenido/a:</B><?php /* echo $_SESSION['usuario']; */ ?> <BR><BR>
		<B>Identificador Apostador:</B><?php /* echo $_SESSION['id']; */ ?>  <BR>
		
	
	<form method="post" action="RealizarSorteo_controllers.php">
			<p>
			Sorteos Activos:
			<?php
				echo "Mostrar todos los sorteos";
				echo "una variable fecha date con formato y/m/d";
				echo "Elegir numeros y meterlo en una session";
				echo "El importe es un 1E";
				echo "Puede apostar las que quiera";
				/* mostrarSelect($_SESSION['id']); */
			/* 	DNI       
				NSORTEO  
				FECHA           
				N1
				N2
				N3
				N4
				N5
				N6
				C 
				IMPORTE_PREMIO
				CATEGORIA_PREMIO */
			?>
			</p>
			<div>
			</div>
			<div>
				<input type='submit' name='accion' value='Realizar Apuesta'/>
				<input type='submit' name='accion' value='Atras'/>
			</div>
	</form>
</body>
</html>	
