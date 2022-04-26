<?php
function vuelos($id){
	try {
		$conexion=conexion();
		$select = $conexion->prepare("SELECT booking_id FROM booking WHERE passenger_id='$id'");	 
		$select->execute();
		// $resultado= $select->fetchAll(PDO::FETCH_NUM);
		// return $resultado;	
		echo "<select name='idBooking' required>";
		foreach($select->fetchAll() as $consulta){
			echo '<option value="'.$consulta["booking_id"].'">Reserva: '.$consulta["booking_id"].'</option>';
		}
		echo "</select>";
	}
	catch(PDOException $e){
		echo "Error vuelos()"."<br>";
		echo $e->getMessage();
	}
	$conexion=null;	
}
function consultarDatos($conexion,$idBooking,$idUsuario){
	try {
		$consulta = $conexion->prepare("SELECT p.name nombre,p.emailaddress email,p.country pais,p.telephoneno movil,f.flightno vuelo,b.seat asiento ,a1.name origen,f.departure salida,a2.name destino,f.arrival llegada,b.price precio
		FROM flight f,airport a1, airport a2,booking b,passengerdetails p
		WHERE a1.airport_id=f.from_a 
		AND a2.airport_id=f.to_a 
		AND f.flight_id=b.flight_id
		AND b.passenger_id=p.passenger_id
		AND booking_id='$idBooking' 
		AND p.passenger_id='$idUsuario'");	 
		$consulta->execute();
		$resultado= $consulta->fetchAll(PDO::FETCH_NUM);
		return $resultado;	
	}
	catch(PDOException $e){
		echo "Error consultarDatos()"."<br>";
		echo $e->getMessage();
	}
}

function idBooking($conexion,$idVuelo,$idUsuario){
	try {
		$consulta=$conexion->prepare("SELECT booking_id FROM booking WHERE passenger_id='$idUsuario' AND flight_id='$idVuelo'");
		$consulta->execute();
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;	
	}
	catch(PDOException $e){
			echo "Error idBooking()"."<br>";
			echo $e->getMessage();
	}
}
?>