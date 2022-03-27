<?php
//Revisar
function comprobarDNI($conexion,$dni){
	try{
		$consulta=$conexion->prepare("SELECT dni FROM empleado Where dni='$dni'");
		$consulta->execute();
	}
	catch (PDOException $e) {
		echo "Error comprobarDNI"."<br>";
		echo $e->getMessage();
	}
}

function insertEmpleado($conexion,$dni,$nombre,$apellido,$email){
	try{
		$insert= "INSERT INTO empleado VALUES ('$dni','$nombre','$apellido','$email')";
		$conexion->exec($insert);
		echo "Empleado insertado";
	}
	catch (PDOException $e) {
		echo "Empleado ya existe"."<br>";
		echo $e->getMessage();
	}
}

?>