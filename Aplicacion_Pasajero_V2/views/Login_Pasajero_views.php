<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../views/css/bootstrap.min.css">
    <title>LOGIN PASAJERO</title>
 </head>
      
<body>
    <div class="container ">
		<h1>LOGIN PASAJERO</h1> 
        <!--Aplicacion-->
	
		<form id="" name="" action="Login_Pasajero_controllers.php" method="post" class="card-body">
		
		<div class="form-group">
			Usuario <input type="text" name="usuario" placeholder="usuario" class="form-control" >
        </div>
		<div class="form-group">
			Contraseña <input type="password" name="password" placeholder="contraseña" class="form-control">
        </div>				
        
		<input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
		<input type="button" value="Atras" onclick="window.location.href='../index.php'" class="btn btn-warning disabled">
        </form>	
	</div>
</body>
</html>