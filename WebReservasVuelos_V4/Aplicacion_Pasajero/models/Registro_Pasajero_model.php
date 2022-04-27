<?php
function comprobarPasajero($conexion,$usuario,$password){
	try{
		$consulta=$conexion->prepare("SELECT emailaddress,birthdate FROM passengerdetails WHERE emailaddress='$usuario' AND birthdate='$password'");
		$consulta->execute();
		$resultado= $consulta->fetchAll();
		return $resultado;
	}
	catch (PDOException $e) {
		echo "Error comprobarPasajero()"."<br>";
		echo $e->getMessage();
	}
}
function insertPasajero($conexion,$idParaAsignar,$nombre,$nacimiento,$sexo,$calle,$ciudad,$cp,$pais,$email,$telefono){
	try{
		$insert= "INSERT INTO passengerdetails VALUES ('$idParaAsignar','$nombre','$nacimiento','$sexo','$calle','$ciudad','$cp','$pais','$email','$telefono')";
		$conexion->exec($insert);
		echo "Pasajero insertado";
	}
	catch (PDOException $e) {
		echo "Error el pasajero ya existe"."<br>";
		echo $e->getMessage();
	}
}
function idPasajero($conexion){
		try{
			$consulta=$conexion->prepare("SELECT MAX(passenger_id) as codigo FROM passengerdetails");
			$consulta->execute();
			
			foreach($consulta->fetchAll() as $consulta){
				$idPasajeroBD=$consulta['codigo'];
			}
			
			if($idPasajeroBD==null){
				$idPasajero=1;
				return $idPasajero;
			}
			else{
				$idPasajero=$idPasajeroBD;
				$idPasajero+=1;
				return $idPasajero;
			}
		}
		catch (PDOException $e) {
			echo "Error idPasajero()"."<br>";
			echo $e->getMessage();
		}	
}
?>