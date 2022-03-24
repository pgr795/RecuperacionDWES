<?php
function realizarApuesta($conexion,$Apuesta){
	try{
		$nSorteo=$combinacionGanadora[8];
		if($nSorteo!=null){
			añadirCombinacion($conexion,$nSorteo,$combinacionGanadora);
			actualizarPremios($conexion,$nSorteo);
			finalizarSorteo($conexion,$nSorteo);
			echo "El sorteo ".$nSorteo." se ha cerrado";
		}
		/* else{
			echo "No has dado al boton de GENERAR COMBINACION";
		} */
	}
	catch(PDOException $e){
			echo "Error realizarSorteo"."<br>";
			echo $e->getMessage();
	}
}
function añadirApuesta($conexion,$nSorteo,$combinacionGanadora){
	try{
		$combinacion="";
		foreach ($combinacionGanadora as $indice => $valor){
			if($indice!=8){
				$numero=strval($valor);
				$combinacion.=$numero." ";
			}
		}
		$actualizar= "UPDATE sorteo SET COMBINACION_GANADORA ='$combinacion' WHERE nSorteo='$nSorteo'";
		$conexion->exec($actualizar);
		//var_dump($combinacion);
	}
	catch(PDOException $e){
			echo "Error añadirCombinacion"."<br>";
			echo $e->getMessage();
	}
}
function actualizarSaldo($conexion,$nSorteo){
	try{
		// $recaudacion=recaudacionTotal($conexion,$nSorteo);
		// $recaudacionPremios=intval($recaudacion[0]/2);
		//var_dump($recaudacionPremios);
		$actualizar= "UPDATE sorteo SET recaudacion_premios ='$recaudacionPremios' WHERE nSorteo='$nSorteo'";
		$conexion->exec($actualizar);
	}
	catch(PDOException $e){
			echo "Error actualizarPremios"."<br>";
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
function recaudacionTotal($conexion,$nSorteo){
	try{
		$consulta=$conexion->prepare("select recaudacion from sorteo where nsorteo='$nSorteo'");
		$consulta->execute();
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;			
	}
	catch(PDOException $e){
			echo "Error recaudacionTotal"."<br>";
			echo $e->getMessage();
	}
}
?>
