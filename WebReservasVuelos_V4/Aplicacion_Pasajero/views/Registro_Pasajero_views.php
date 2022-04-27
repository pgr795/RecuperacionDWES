<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../views/css/bootstrap.min.css">
	<title>Registro Pasajero</title>
</head>
<body>
		<div class="container">
			<h2 align="center">Alta de Pasajero</h2>
			<div class="card border-success mb-3">
			<div class="card-body">
				<form method="post" action="Registro_Pasajero_controllers.php">
					<p>Nombre: <input type='text' name='nombre' maxlength="40" size=40/></p>
					<p>Fecha de nacimiento: <input type='date' name='cumple'/></p>
					<div><label for="Sexo">Sexo:</label>
						<label for="Hombre">Hombre</label>
						<input type='radio' name='sex' value="M"/>
						<label for="Mujer">Mujer</label>
						<input type='radio' name='sex' value="W"/>
					</div>
					<p>Calle: <input type='text' name='calle'/></p>
					<p>Ciudad: <input type='text' name='ciudad'/></p>
					<p>Codigo Postal: <input type='number' name='codigoPostal' min="1"  max="99999" value="00000" /></p>
					<p>Pais: <input type='text' name='pais'/></p>
					<p>Email: <input type='text' name='email' maxlength="60" size="60"></p>
					<p>Telefono: <input type='text' name='telefono' maxlength="9" size="9"/></p>
					<input type='submit' name='accion' value='Registro Pasajero' class="btn btn-warning disabled"/>
					<input type="button" value="Atras" onclick="window.location.href='../index.php'" class="btn btn-warning disabled">
				</form>
			</div>
			</div>
		</div>
</body>
</html>