<?php
//Revisar
function registroApostante($conexion,$dni,$nombre,$apellido,$email,$saldo){
	try{
		$insert= "INSERT INTO apostante VALUES ('$dni','$nombre','$apellido','$email','$saldo')";
		$conexion->exec($insert);
	}
	catch (PDOException $e) {
		echo "Error registroApostante"."<br>";
		echo $e->getMessage();
	}
}

function comprobarDNI($conexion,$dni){
	try{
		$consulta=$conexion->prepare("SELECT dni FROM apostante Where dni='$dni'");
		$consulta->execute();
		$cont=0;
		
		foreach($consulta->fetchAll() as $consulta){
                $dniBD=$consulta["dni"];
				$cont++;
		}
		return $cont;
	}
	catch (PDOException $e) {
		echo "Error comprobarDNI"."<br>";
		echo $e->getMessage();
	}
}

?>