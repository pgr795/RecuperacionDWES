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
	<title>Realizar Apuesta</title>
</head>
<body>
	<div class="card-header"><h2>Realizar Apuesta</h2></div>
		<div class="card-body">

		<B>Bienvenido/a:</B><?php echo $_SESSION['usuario']; ?> <BR><BR>
		<B>Identificador Apostador:</B><?php echo $_SESSION['id']; ?>  <BR>
		
	
	<form method="post" action="RealizarApuesta_controllers.php">
			<p>
			Sorteos Activos:
			<?php
				mostrarSelect($_SESSION['id']); 
				echo "<br>";
			?>
			</p>
			<p>
			<?php
				function mostrarNumeros(){
				echo "<h2 style='color:gray;'>"."Loteria Primitiva de España</h2>";
				echo "<h2 style='color:gray;'>Numeros:</h2>";
				echo "<table>";
				echo "<tr>";
				for ($i = 1; $i<=49; $i++){
						
						echo "<td><img src=../views/bolas/".$i.".png width=70px height=70px>"." "."<td>";
						if($i==9){
							echo "</tr>";
						}
						if($i==19){
							echo "</tr>";
						}
						if($i==29){
							echo "</tr>";
						}
						if($i==39){
							echo "</tr>";
						}
						if($i==49){
							echo "</tr>";
						}
				}
				echo "</table>";
			}
			?>
			</p>
			<p>
			<?php
				function mostrarReintegro(){
				echo "<br>";
				echo "<h2 style='color:gray;'>Reintegro:</h2>";
				echo "<table>";
				echo "<tr>";
				for ($i = 1; $i<=9; $i++){
					echo "<td><img src=../views/bolas/rbola".$i.".png width=70px height=70px>"." "."<td>";
				}
				echo "</table>";
			}
			?>
			</p>
			<p>
				<input type='text' name='n1'  maxlength="2" size=2 placeholder="N1" />
				<input type='text' name='n2' maxlength="2" size=2 placeholder="N2" />
				<input type='text' name='n3'  maxlength="2" size=2 placeholder="N3" />
				<input type='text' name='n4'  maxlength="2" size=2 placeholder="N4" />
				<input type='text' name='n5'  maxlength="2" size=2 placeholder="N5"/>
				<input type='text' name='n6'  maxlength="2" size=2 placeholder="N6"/>
				<input type='text' name='c'  maxlength="2" size=2 placeholder="C"/>
				<input type='text' name='r'  maxlength="2" size=2 placeholder="R"/>
			</p>
			<div>
				<input type='submit' name='accion' value='Agregar Apuestas' class="btn btn-warning disabled"/>
				<input type='submit' name='accion' value='Realizar Apuesta' class="btn btn-warning disabled"/>
				<input type="button" value="Atras" onclick="window.location.href='Inicio_Apuestas_controllers.php'" class="btn btn-warning disabled">
			</div>
	</form>
</body>
</html>	
