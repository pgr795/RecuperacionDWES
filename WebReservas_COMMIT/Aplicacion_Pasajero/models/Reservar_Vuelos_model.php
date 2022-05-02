<?php
////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES 
////////////////////////////////////////////////////////////////////////////////////////////////
function insertBooking($conexion,$idBooking,$idFlight,$seat,$passenger_id,$price){
	try{
		$insert= "INSERT INTO booking VALUES ('$idBooking','$idFlight',null,'$passenger_id','$price')";
		$conexion->exec($insert);
	}
	catch (PDOException $e) {
		echo "Error insertBooking()"."<br>";
		echo $e->getMessage();
	}
}
function maxIdBooking($conexion){
		try{
		$consulta=$conexion->prepare("SELECT max(booking_id) as codigo FROM booking");
		$consulta->execute();
		
		foreach($consulta->fetchAll() as $consulta){
			$idBookingBD=$consulta['codigo'];
		}
		
		if($idBookingBD==null){
			$idBooking=1;
			return $idBooking;
		}
		else{
			$idBooking=$idBookingBD;
			$idBooking+=1;
			return $idBooking;
		}
	}
	catch (PDOException $e) {
		echo "Error maxIdBooking()"."<br>";
		echo $e->getMessage();
	}
}
function airplaneID($conexion,$vuelo){
	try{
		$consulta=$conexion->prepare("SELECT airplane_id FROM flight WHERE flight_id='$vuelo'");
		$consulta->execute();
		
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;
	}
	catch (PDOException $e) {
		echo "Error airplaneID()"."<br>";
		echo $e->getMessage();
	}
}
function capacityVuelo($conexion,$idVuelo){
	try{
		$consulta=$conexion->prepare("SELECT capacity FROM airplane WHERE airplane_id='$idVuelo'");
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
function vueloFromTo($conexion,$idVuelo){
	try{
		$select = $conexion->prepare("SELECT f.flightno vuelo, a1.name origen, a2.name destino
		FROM flight f,airport a1, airport a2
		WHERE a1.airport_id=f.from_a 
		AND a2.airport_id=f.to_a 
		AND flight_id ='$idVuelo'");	 
		$select->execute();
		$resultado= $select->fetchAll(PDO::FETCH_NUM);
		return $resultado;	
	}
	catch(PDOException $e){
		echo "Error SelectVuelos()"."<br>";
		echo $e->getMessage();
	}
}
function precioPorVuelo($conexion,$idFlight,$passenger_id){
	try{
		$consulta = $conexion->prepare("SELECT price FROM booking WHERE passenger_id='$passenger_id' AND flight_id='$idFlight'");	 
		$consulta->execute();
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;	
	}
	catch(PDOException $e){
		echo "Error precioPorVuelo()"."<br>";
		echo $e->getMessage();
	}	
}
function SelectVuelos($id){
	try {
		$conexion=conexion();
		$select = $conexion->prepare("SELECT f.flight_id,f.flightno vuelo, a1.name origen, a2.name destino
		FROM flight f,airport a1, airport a2
		WHERE a1.airport_id=f.from_a 
		AND a2.airport_id=f.to_a 
		AND flight_id 
		NOT IN (SELECT f.flight_id FROM flight f,booking b WHERE f.flight_id=b.flight_id AND b.passenger_id='$id' AND b.seat IS NULL) 
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
		echo "Error SelectVuelos()"."<br>";
		echo $e->getMessage();
	}
	$conexion=null;
}
function datosVuelo($conexion,$valor){
	try{
		$consulta=$conexion->prepare("SELECT f.flightno vuelo, a1.name origen, a2.name destino
		FROM airport a1, airport a2, flight f
		WHERE a1.airport_id=f.from_a
		AND a2.airport_id=f.to_a
		AND flight_id='$valor'");
		$consulta->execute();
		
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;
	}
	catch (PDOException $e) {
		echo "Error datosVuelos()"."<br>";
		echo $e->getMessage();
	}	
}

/* SELECT f.flight_id,f.flightno vuelo, a1.name origen, a2.name destino
		FROM flight f,airport a1, airport a2, airplane air
		WHERE a1.airport_id=f.from_a 
		AND a2.airport_id=f.to_a
		AND a1.airplane_id=air.airplane_id
		AND flight_id 
		NOT IN (SELECT f.flight_id FROM flight f,booking b WHERE f.flight_id=b.flight_id AND b.passenger_id='4' AND b.seat IS NULL) 
		AND air.capacity!='maxCapacidad';
		ORDER BY origen ASC */
?>