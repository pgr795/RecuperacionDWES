<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../views/css/bootstrap.min.css">
	<title>Registro Empleado</title>
</head>
<body>
	<h2>Alta de Registro</h2>
	<form method="post" action="Registro_controllers.php">
			<p>DNI: <input type='text' name='dni' maxlength="9" size=9></p>
			<p>Nombre: <input type='text' name='nombre' maxlength="40" size=40></p>
			<p>Apellido: <input type='text' name='apellido' maxlength="20" size=20></p>
			<p>EMAIL: <input type='text' name='email' maxlength="60" size=60></p>
			<input type='submit' name='accion' value='Registro Empleado' class="btn btn-warning disabled"/>
			<input type='submit' name='accion' value='Atras' class="btn btn-warning disabled"/>
	</form>
</body>
</html>