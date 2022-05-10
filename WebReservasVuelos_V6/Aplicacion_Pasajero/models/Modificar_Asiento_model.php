<?php
function vuelosReservados($id){
	try {
		$conexion=conexion();
		$select = $conexion->prepare("SELECT b.booking_id reserva,f.flight_id id,f.flightno vuelo, a1.name origen, a2.name destino
		FROM flight f,airport a1, airport a2, booking b
		WHERE a1.airport_id=f.from_a 
		AND a2.airport_id=f.to_a 
		AND f.flight_id=b.flight_id
		AND b.passenger_id='$id' AND SEAT IS NOT NULL
		ORDER BY reserva ASC"); 
		$select->execute();
		// $resultado= $select->fetchAll(PDO::FETCH_NUM);
		// return $resultado;	
		
		echo "<select required autofocus multiple name='idVuelo' required>";
			foreach($select->fetchAll() as $consulta){
				echo '<option value="'.$consulta["reserva"].'">'."Reserva:".$consulta["reserva"]." |".$consulta["vuelo"]."|".$consulta["origen"]."-".$consulta["destino"]."|".'</option>';
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
		$consulta=$conexion->prepare("SELECT airplane_id FROM flight f WHERE f.flight_id='$idVuelo'");
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
function asientoActual($conexion,$idvuelo,$idUsuario){
	try {
		$consulta=$conexion->prepare("SELECT seat FROM booking WHERE booking_id='$idvuelo' AND passenger_id='$idUsuario'");
		$consulta->execute();
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;	
	}
	catch(PDOException $e){
			echo "Error asientoActual()"."<br>";
			echo $e->getMessage();
	}	
}
function AsientosAvionOcupados($conexion,$idVuelo){
	try {
		$consulta=$conexion->prepare("select seat from booking where flight_id='$idVuelo'");
		$consulta->execute();
		// $resultado= $consulta->fetch(PDO::FETCH_NUM);
		$resultado= $consulta->fetchAll(PDO::FETCH_COLUMN);
		return $resultado;	
	}
	catch(PDOException $e){
			echo "Error AsientosAvionOcupados()"."<br>";
			echo $e->getMessage();
	}
}
function actualizarAsiento($conexion,$cambiarAsiento,$asientoActual,$idVuelo,$idUsuario){
	try{
		$updates= "UPDATE booking SET seat='$cambiarAsiento' WHERE booking_id='$idVuelo' AND passenger_id='$idUsuario' AND seat='$asientoActual'";
		$conexion->exec($updates);
		echo "<h2 class='card-body' align='center' style='color:gray;'>Se ha modificado tu asiento de: ".$asientoActual." a ".$cambiarAsiento."</h2>";
	}		
	catch(PDOException $e){
			echo "Error actualizar()"."<br>";
			echo $e->getMessage();
	}	
}

?>
