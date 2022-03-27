<?php
////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES PRINCIPALES
////////////////////////////////////////////////////////////////////////////////////////////////

function realizarApuesta($conexion,$dni,$sorteo,$fecha,$apuestas){
	try{
		if($apuestas!=null){
			$numerosApuestas=count($apuestas);
			insertarApuesta($conexion,$dni,$sorteo,$fecha,$apuestas);
			actualizarPremioRecaudacion($conexion,$sorteo,$numerosApuestas);
			actualizarSaldo($conexion,$dni,$numerosApuestas);
			echo "Apuesta Realizada en el SORTEO:$sorteo"."<br>";
		}
		else{
			echo "No se ha realizado ninguna apuesta en el SORTEO:$sorteo"."<br>";
		}
	}
	catch(PDOException $e){
			echo "Error realizarApuesta"."<br>";
			echo $e->getMessage();
	}
}

function insertarApuesta($conexion,$dni,$sorteo,$fecha,$apuestas){
	try{
			foreach($apuestas as $consulta){
				$n1=$consulta[0][0];
				$n2=$consulta[1][0];
				$n3=$consulta[2][0];
				$n4=$consulta[3][0];
				$n5=$consulta[4][0];
				$n6=$consulta[5][0];
				$c=$consulta[6][0];
				$r=$consulta[7][0];
				
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
		var_dump($recaudacion);
		var_dump($nuevaCantidad);
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
		
		var_dump($saldo);
		var_dump($nuevaCantidad);
		
		
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
			echo '<option value="'.$consulta["NSORTEO"].'">'.$consulta["NSORTEO"].'</option>';
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
