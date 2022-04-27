<?php
function vuelosReservados($id){
	try {
		$conexion=conexion();
		$select = $conexion->prepare("SELECT f.flight_id,f.flight_id,f.flightno vuelo, a1.name origen, a2.name destino
		FROM flight f,airport a1, airport a2
		WHERE a1.airport_id=f.from_a 
		AND a2.airport_id=f.to_a 
		AND flight_id 
		IN (SELECT f.flight_id FROM flight f,booking b WHERE f.flight_id=b.flight_id AND b.passenger_id='$id' AND b.seat IS NULL) 
		ORDER BY origen ASC");	 
		$select->execute();
		// $resultado= $select->fetchAll(PDO::FETCH_NUM);
		// return $resultado;	
		
		echo "<select name='idVuelo' required>";
			foreach($select->fetchAll() as $consulta){
				echo '<option value="'.$consulta["flight_id"].'">'.$consulta["vuelo"]." ".$consulta["origen"]."-".$consulta["destino"].'</option>';
			}
		echo "</select>";
		}
	catch(PDOException $e){
		echo "Error vuelosReservados()"."<br>";
		echo $e->getMessage();
	}
	$conexion=null;
}
function idAirplane($conexion,$idVuelo){
	try{
		$consulta=$conexion->prepare("SELECT airline_id FROM flight f WHERE f.flight_id='$idVuelo'");
		$consulta->execute();
		
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;
	}
	catch (PDOException $e) {
		echo "Error capacityVuelo()"."<br>";
		echo $e->getMessage();
	}
}
function capacityVuelo($conexion,$idAirplane){
	try{
		$consulta=$conexion->prepare("SELECT capacity FROM airplane a1 WHERE a1.airplane_id='$idAirplane'");
		$consulta->execute();
		
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;
	}
	catch (PDOException $e) {
		echo "Error capacityVuelo()"."<br>";
		echo $e->getMessage();
	}
}
function contVuelo($conexion,$idVuelo){
	try{
		$consulta=$conexion->prepare("SELECT count(seat) FROM booking WHERE flight_id='$idVuelo'");
		$consulta->execute();
		
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;
	}
	catch (PDOException $e) {
		echo "Error contVuelo()"."<br>";
		echo $e->getMessage();
	}
}
function idBooking($conexion,$idVuelo,$idUsuario){
	try {
		$consulta=$conexion->prepare("SELECT booking_id FROM booking WHERE passenger_id='$idUsuario' AND flight_id='$idVuelo' AND seat IS NULL");
		$consulta->execute();
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;	
	}
	catch(PDOException $e){
			echo "Error idBooking()"."<br>";
			echo $e->getMessage();
	}
}
function asignarAsientos($conexion,$idBooking,$idUsuario,$asiento){	
	try {
		$updates= "UPDATE booking SET seat='$asiento' WHERE booking_id='$idBooking' AND passenger_id='$idUsuario'";
		$conexion->exec($updates);
	}
	catch(PDOException $e){
		echo "Error asignarAsientos()"."<br>";
		echo $e->getMessage();
	}
}
function comprobarAsiento($conexion,$idUsuario,$idVuelo,$asiento){
	try {
		$consulta=$conexion->prepare("SELECT seat from booking where passenger_id='$idUsuario' and flight_id='$idVuelo' and seat='$asiento'");
		$consulta->execute();
		$resultado= $consulta->fetch(PDO::FETCH_ASSOC);
		var_dump($resultado);
		return $resultado;	
	}
	catch(PDOException $e){
			echo "Error comprobarAsiento()"."<br>";
			echo $e->getMessage();
	}	
}
?>
