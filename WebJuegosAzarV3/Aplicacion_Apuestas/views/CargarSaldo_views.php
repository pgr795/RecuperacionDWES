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
	<title>Cargar Saldo</title>
</head>
<body>
	<div class="card-header"><h2>Cargar Saldo</h2></div>
		<div class="card-body">

		<B>Bienvenido/a:</B><?php echo $_SESSION['usuario']; ?> <BR><BR>
		<B>Identificador Apostador:</B><?php echo $_SESSION['id']; ?>  <BR>
		
	
	<form method="post" action="AltaSorteo_controllers.php">
			<p>Fecha: <input type="datetime-local" name="fecha"></p>
			<input type='submit' name='accion' value='Cargar Saldo'/>
			<input type='submit' name='accion' value='Atras'/>
	</form>
</body>
</html>	
