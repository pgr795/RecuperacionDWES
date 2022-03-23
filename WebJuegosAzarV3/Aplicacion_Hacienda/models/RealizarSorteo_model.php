<?php
function realizarSorteo($conexion,$combinacionGanadora){
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
function añadirCombinacion($conexion,$nSorteo,$combinacionGanadora){
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
function actualizarPremios($conexion,$nSorteo){
	try{
		$recaudacion=recaudacionTotal($conexion,$nSorteo);
		$recaudacionPremios=intval($recaudacion[0]/2);
		//var_dump($recaudacionPremios);
		$actualizar= "UPDATE sorteo SET recaudacion_premios ='$recaudacionPremios' WHERE nSorteo='$nSorteo'";
		$conexion->exec($actualizar);
	}
	catch(PDOException $e){
			echo "Error actualizarPremios"."<br>";
			echo $e->getMessage();
	}
}
function finalizarSorteo($conexion,$nSorteo){
	try{
		$actualizar= "UPDATE sorteo SET activo='N' WHERE nSorteo='$nSorteo'";
		$conexion->exec($actualizar);
	}
	catch(PDOException $e){
			echo "Error finalizarSorteo"."<br>";
			echo $e->getMessage();
	}
}
function combinacionGanadora(){
    $combinacionGanadora=array(); //Array Vacio
    $contador=0;
	
    while($contador != 7){
       
	   $bola=bolas(); //Bola Random
		
        if(!in_array($bola,$combinacionGanadora)){
            $combinacionGanadora[$contador]=$bola;
            $contador++;
		}
		
		else{
            $bola=bolas();
		}
    }   
    $combinacionGanadora[7]=reintegro();
    return $combinacionGanadora;
}
function bolas(){
    $bola=rand(1,49);
    return $bola;
}
function reintegro(){
    $reintegro=rand(1,9);
    return $reintegro;
}
function mostrarSelect($id){
	try {
		$conexion=conexion();
		$select = $conexion->prepare("SELECT NSORTEO FROM sorteo WHERE activo='S' AND dni='$id'");	 
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
