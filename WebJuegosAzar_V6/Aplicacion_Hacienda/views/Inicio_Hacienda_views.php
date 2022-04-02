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
		<title>INICIO HACIENDA</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="../views/css/bootstrap.min.css">
 </head>
   
 <body>
    <h1>INICIO HACIENDA</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Empleado - OPERACIONES </div>
		<div class="card-body">
		<BR>

		<B>Bienvenido/a:</B><?php echo $_SESSION['usuario']; ?> <BR><BR>
		<B>Identificador Empleado:</B><?php echo $_SESSION['id']; ?>  <BR><BR>
	 
		
       <!--Formulario con botones -->
	
		<input type="button" value="Alta de Sorteos" onclick="window.location.href='AltaSorteo_controllers.php'" class="btn btn-warning disabled">
		<input type="button" value="Realizar Sorteo" onclick="window.location.href='RealizarSorteo_controllers.php'" class="btn btn-warning disabled">
		<input type="button" value="Consultar Sorteo" onclick="window.location.href='ConsultarSorteo_controllers.php'" class="btn btn-warning disabled">
		</br></br>
		
		
		  <BR><a href="CerrarSesion_controllers.php">Cerrar Sesión</a>
	</div>  
	  
	  
     
   </body>
   
</html>


