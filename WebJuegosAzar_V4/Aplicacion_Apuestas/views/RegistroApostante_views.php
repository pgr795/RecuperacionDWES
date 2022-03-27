<?php
	if(isset($_SESSION['usuario'])){
		unset($_SESSION['usuario']);
		session_destroy();
		setcookie ("PHPSESSID", $_COOKIE['PHPSESSID'], time() - 864000, '/');
		var_dump($_SESSION);
	}

?>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../views/css/bootstrap.min.css">
	<title>Registro Apostante</title>
</head>
<body>
	<h2>Alta de Registro</h2>
	<form method="post" action="../pasarela/GeneraPet.php">
			<p>DNI: <input type='text' name='dni' maxlength="9" size=9></p>
			<p>Nombre: <input type='text' name='nombre' maxlength="40" size=40></p>
			<p>Apellido: <input type='text' name='apellido' maxlength="20" size=20></p>
			<p>Email: <input type='text' name='email' maxlength="60" size=60></p>
			<p>Saldo: <input type='text' name="saldo" value="0">*Para poner decimales Ej: 14.50 </p>
			<input type='submit' name='accion' value='Registro Apostante'/>
			<input type="button" value="Atras" onclick="window.location.href='../index.php'" class="btn btn-warning disabled">
	</form>
</body>
</html>