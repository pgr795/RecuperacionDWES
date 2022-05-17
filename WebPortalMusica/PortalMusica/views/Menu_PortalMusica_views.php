<?php
	if(!isset($_SESSION['id']) && !isset($_SESSION['nombre']) && !isset($_SESSION['company'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['company']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
	}
	
?>
<html>
 <head>
		<title>PORTAL DE MUSICA</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
   
 <body>
    <div class="container ">
		<h1>PORTAL DE MUSICA</h1> 
		<br>
        <!--Aplicacion-->
		
		<div class="card-header">MENÚ USUARIO SPOTIFY</div>
		<div class="card-body">
		
		<B>Nombre Cliente: </B><?php echo $_SESSION['id']; ?> <BR><BR>
		<B>Id Cliente: </B><?php echo $_SESSION['nombre']; ?> <BR><BR>
		<B>Compañia: </B><?php echo $_SESSION['company']; ?>  <BR><BR>
		
       <!--Formulario con botones -->
	
		<input type="button" value="Descargas" onclick="window.location.href='Descargas_controllers.php'" class="btn btn-warning disabled" >
		<input type="button" value="Consultar Historial" onclick="window.location.href='Consultar_Historial_controllers.php'" class="btn btn-warning disabled">
		<input type="button" value="Consultar Facturas" onclick="window.location.href='Consultar_Facturas_controllers.php'" class="btn btn-warning disabled">
		<br>
		<br>
		<a href="CerrarSesion_controllers.php">Cerrar Sesión</a>
	</div>  
	</div> 
	
   </body>  
</html>
