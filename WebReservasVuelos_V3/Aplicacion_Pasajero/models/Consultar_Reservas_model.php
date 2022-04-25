<?php
function vuelos($id){
	try {
		$conexion=conexion();
		$select = $conexion->prepare("SELECT f.flight_id,f.flightno vuelo
		FROM flight f,airport a1, airport a2
		WHERE a1.airport_id=f.from_a 
		AND a2.airport_id=f.to_a 
		AND flight_id 
		IN (SELECT f.flight_id FROM flight f,booking b WHERE f.flight_id=b.flight_id AND b.passenger_id='$id') 
		ORDER BY vuelo ASC");	 
		$select->execute();
		// $resultado= $select->fetchAll(PDO::FETCH_NUM);
		// return $resultado;	
		echo "<select name='idVuelo' required>";
		foreach($select->fetchAll() as $consulta){
			echo '<option value="'.$consulta["flight_id"].'">'.$consulta["vuelo"].'</option>';
		}
		echo "</select>";
	}
	catch(PDOException $e){
		echo "Error vuelos()"."<br>";
		echo $e->getMessage();
	}
	$conexion=null;	
}
function consultarDatos($conexion,$idVuelo,$idUsuario){
	try {
		$consulta = $conexion->prepare("SELECT p.name nombre,p.emailaddress email,p.country pais,p.telephoneno movil,f.flightno vuelo,b.seat asiento ,a1.name origen,f.departure salida,a2.name destino,f.arrival llegada,b.price precio
		FROM flight f,airport a1, airport a2,booking b,passengerdetails p
		WHERE a1.airport_id=f.from_a 
		AND a2.airport_id=f.to_a 
		AND f.flight_id=b.flight_id
		AND b.passenger_id=p.passenger_id
		AND f.flight_id='$idVuelo' 
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
?>