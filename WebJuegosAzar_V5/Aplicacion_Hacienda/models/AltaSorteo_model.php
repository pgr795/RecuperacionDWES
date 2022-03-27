<?php

function numeroSorteo(){
	try{
		$conexion=conexion();
		$consulta=$conexion->prepare("SELECT max(NSORTEO) as codigo FROM sorteo");
		$consulta->execute();
		
		foreach($consulta->fetchAll() as $consulta){
			$numeroSorteoBD=$consulta['codigo'];
		}
		
		if($numeroSorteoBD==null){
			$numeroSorteo="S001";
			return $numeroSorteo;
		}
		else{
			$numeroSorteo=substr($numeroSorteoBD,-3);
			$numeroSorteo+=1;
			$numeroSorteo="S".str_pad($numeroSorteo, 3, "0", STR_PAD_LEFT);
			return $numeroSorteo;
		}
		
	}
	catch (PDOException $e) {
		echo "Error numeroSorteo"."<br>";
		echo $e->getMessage();
	}
}


function insertSorteo($conexion,$fecha,$dni){
	try{
		if($fecha!=''){
			$nSorteo=numeroSorteo();
			$insert="INSERT INTO sorteo VALUES ('$nSorteo','$fecha','0','0','$dni','S','')";
			$conexion->exec($insert);
			echo "Se ha dado de alta el sorteo";
		}
		else{
			echo "No se ha introducido la fecha";
		}
	}
	catch (PDOException $e) {
		echo "Error insertSorteo"."<br>";
		echo $e->getMessage();
	}
}
?>