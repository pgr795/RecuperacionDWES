<?php
////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES PRINCIPALES
////////////////////////////////////////////////////////////////////////////////////////////////

function realizarApuesta($conexion,$dni,$sorteo,$fecha,$apuestas){
	try{
		if($apuestas!=null){
			$apuestasValidas=comprobarApuestas($conexion,$dni,$sorteo,$apuestas);
			$numerosApuestas=count($apuestasValidas);
			insertarApuesta($conexion,$dni,$sorteo,$fecha,$apuestasValidas);
			actualizarPremioRecaudacion($conexion,$sorteo,$numerosApuestas);
			actualizarSaldo($conexion,$dni,$numerosApuestas);
		}
		else{
			echo "No se ha realizado ninguna apuesta en el SORTEO: $sorteo"."<br>";
		}
	}
	catch(PDOException $e){
			echo "Error realizarApuesta"."<br>";
			echo $e->getMessage();
	}
}

function comprobarApuestas($conexion,$dni,$sorteo,$apuestas){
	//var_dump($apuestas);
	$numApuestas=count($apuestas);
	$contadorApuesta=0;
	$repetidos=array();
	$numValidos=array();
	
	while($contadorApuesta < $numApuestas){
		$apuesta=$apuestas[$contadorApuesta];
		//var_dump($apuesta); 
		$repetidos=array_count_values($apuesta);
		if(in_array(2,$repetidos)||in_array(3,$repetidos)||in_array(4,$repetidos)||in_array(5,$repetidos)||
		in_array(6,$repetidos)||in_array(7,$repetidos)||in_array(8,$repetidos)){
			$apuesta=null;
			echo "<h2 style='color:gray;'>La apuesta numero:$contadorApuesta no se ha podido realizar la  apuesta.
			Error: numeros repetidos</h2>";
		}
		else{
			echo "<h2 style='color:gray;'>La apuesta numero:$contadorApuesta se ha realizado</h2>";
			array_push($numValidos,$apuesta);
		}
		//var_dump($repetidos);
		//var_dump($apuesta);
		$contadorApuesta++;
	}
	return $numValidos;
}

function insertarApuesta($conexion,$dni,$sorteo,$fecha,$apuestasValidas){
	try{
	// var_dump($apuestasValidas);
			foreach($apuestasValidas as $indice => $valor){
				$n1=$apuestasValidas[$indice][0];
				$n2=$apuestasValidas[$indice][1];
				$n3=$apuestasValidas[$indice][2];
				$n4=$apuestasValidas[$indice][3];
				$n5=$apuestasValidas[$indice][4];
				$n6=$apuestasValidas[$indice][5];
				$c=$apuestasValidas[$indice][6];
				$r=$apuestasValidas[$indice][7];
				$idApuesta=idApuesta($conexion);
				
				$insert="INSERT INTO apuestas VALUES ('$idApuesta','$dni','$sorteo','$fecha','$n1','$n2','$n3','$n4','$n5','$n6','$c','$r',null,null);";
				$conexion->exec($insert);
					
				// var_dump($n1);
				// var_dump($n2);
				// var_dump($n3);
				// var_dump($n4);
				// var_dump($n5);
				// var_dump($n6);
				// var_dump($c);
				// var_dump($r);	
		}	
	}
	catch(PDOException $e){
			echo "Error insertarApuesta"."<br>";
			echo $e->getMessage();
	}
}

function actualizarPremioRecaudacion($conexion,$sorteo,$numerosApuestas){
	try{
		
		$recaudacion=recaudacionSorteo($conexion,$sorteo);
		$nuevaCantidad=$recaudacion['recaudacion']+(1*$numerosApuestas);
		// var_dump($recaudacion);
		// var_dump($nuevaCantidad);
		$updates= "UPDATE sorteo SET recaudacion='$nuevaCantidad' WHERE NSORTEO='$sorteo'";
		$conexion->exec($updates);
	}
	catch(PDOException $e){
			echo "Error actualizarPremioRecaudacion"."<br>";
			echo $e->getMessage();
	}
}

function actualizarSaldo($conexion,$dni,$numerosApuestas){
	try{
		$saldo=saldoApostante($conexion,$dni);
		$nuevaCantidad=$saldo['saldo']-(1*$numerosApuestas);
		
		if($saldo['saldo']!=0){
			$updates= "UPDATE apostante SET SALDO='$nuevaCantidad' WHERE DNI='$dni'";
			$conexion->exec($updates);
		}		
		// var_dump($saldo);
		// var_dump($nuevaCantidad);
	}
	catch(PDOException $e){
			echo "Error actualizarSaldo"."<br>";
			echo $e->getMessage();
	}	
}

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES AUXILIARES
////////////////////////////////////////////////////////////////////////////////////////////////

function idApuesta($conexion){
	try{
		$consulta=$conexion->prepare("SELECT max(NAPUESTA) as codigo FROM apuestas");
		$consulta->execute();
		
		foreach($consulta->fetchAll() as $consulta){
			$numeroSorteoBD=$consulta['codigo'];
		}
		
		if($numeroSorteoBD==null){
			$numeroSorteo=1;
			return $numeroSorteo;
		}
		else{
			$numeroSorteo=$numeroSorteoBD;
			$numeroSorteo+=1;
			return $numeroSorteo;
		}
		
	}
	catch (PDOException $e) {
		echo "Error numeroSorteo"."<br>";
		echo $e->getMessage();
	}
}
function mostrarSelect($id){
	try {
		$conexion=conexion();
		$select = $conexion->prepare("SELECT NSORTEO FROM sorteo WHERE activo='S'");	 
		$select->execute();
			
		echo "<select name='idSorteo'>";
		
		foreach($select->fetchAll() as $consulta){
			echo '<option value="'.$consulta["NSORTEO"].'"selected>'.$consulta["NSORTEO"].'</option>';
		}
		
		echo "</select>";
		
		}
		
		catch(PDOException $e){
			echo "Error mostrarSelect"."<br>";
			echo $e->getMessage();
		}
		$conexion=null;
	}
function sorteos($conexion,$dni){
	try {
		$select = $conexion->prepare("SELECT NSORTEO FROM sorteo WHERE activo='S'");	 
		$select->execute();
			
		$resultado= $select->fetchAll(PDO::FETCH_ASSOC);
		
		return $resultado;
		
		}
		catch(PDOException $e){
			echo "Error sorteos"."<br>";
			echo $e->getMessage();
			}
	}
function recaudacionSorteo($conexion,$sorteo){
	try{
		$consulta=$conexion->prepare("SELECT max(recaudacion) AS recaudacion FROM sorteo WHERE NSORTEO='$sorteo'");
		$consulta->execute();
		
		$resultado=$consulta->fetch(PDO::FETCH_ASSOC);
		
		return $resultado;
	}
	catch(PDOException $e){
			echo "Error recaudacionSorteo"."<br>";
			echo $e->getMessage();
	}
}
function saldoApostante($conexion,$dni){
	try {
		$consulta=$conexion->prepare("SELECT saldo FROM apostante WHERE dni='$dni'");
		$consulta->execute();
		
		$resultado=$consulta->fetch(PDO::FETCH_ASSOC);
		
		return $resultado;
		
		}
		catch(PDOException $e){
			echo "Error saldoApostante"."<br>";
			echo $e->getMessage();
		}
	}
?>
