<?php
	function SelectVuelos(){
	try {
		$conexion=conexion();
		$select = $conexion->prepare("SELECT f.flight_id, f.flightno vuelo, a1.name origen, a2.name destino FROM airport a1, airport a2, flight f WHERE a1.airport_id=f.from_a AND a2.airport_id=f.to_a");	 
		$select->execute();
		// $resultado= $select->fetchAll(PDO::FETCH_NUM);
		// return $resultado;	
		
		echo "<select name='idVuelo'>";
		
		foreach($select->fetchAll() as $consulta){
			echo '<option value="'.$consulta["flight_id"].'">'.$consulta["vuelo"]." ".$consulta["origen"]."-".$consulta["destino"].'</option>';
		}
		
		echo "</select>";
		
		}
	catch(PDOException $e){
			echo "Error SelectVuelos"."<br>";
			echo $e->getMessage();
		}
		$conexion=null;
	}
?>