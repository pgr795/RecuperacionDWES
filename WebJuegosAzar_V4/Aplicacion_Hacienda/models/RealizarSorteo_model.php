<?php
////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES PRINCIPALES
////////////////////////////////////////////////////////////////////////////////////////////////

function realizarSorteo($conexion,$SorteoActivo,$combinacionGanadora,$idUsuario){
	try{
		if($SorteoActivo!=null){
			añadirCombinacion($conexion,$SorteoActivo,$combinacionGanadora);
			actualizarRecaudacion($conexion,$SorteoActivo);
			actualizarAciertos($conexion,$SorteoActivo,$combinacionGanadora);
			actualizarSaldosPremiados($conexion);
			finalizarSorteo($conexion,$SorteoActivo);
			echo "El sorteo ".$SorteoActivo." se ha cerrado";
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
function actualizarRecaudacion($conexion,$SorteoActivo){
	try{
		$recaudacion=recaudacionTotal($conexion,$SorteoActivo);
		$recaudacionPremios=intval($recaudacion[0]/2);
		//var_dump($recaudacionPremios);
		$actualizar= "UPDATE sorteo SET recaudacion_premios ='$recaudacionPremios' WHERE nSorteo='$SorteoActivo'";
		$conexion->exec($actualizar);
	}
	catch(PDOException $e){
			echo "Error actualizarRecaudacion"."<br>";
			echo $e->getMessage();
	}
}

function actualizarAciertos($conexion,$SorteoActivo,$combinacionGanadora){
	try {
		$aciertos=aciertos($conexion,$SorteoActivo,$combinacionGanadora);
		$idApuesta=idAPUESTA($conexion,$SorteoActivo);
		$numeroApuestas=count($aciertos);
		$cont=0;
		$premioRepartir=consultarBote($conexion,$SorteoActivo);
		
		$repartirPremios=intval($premioRepartir[0]);
		
		$primerPremio=$repartirPremios*50/100;
		
		$repartirPremios=$repartirPremios-$primerPremio;
		
		$segundoPremio=$repartirPremios*20/100;
		
		$repartirPremios=$repartirPremios-$segundoPremio;
		
		$tercerPremio=$repartirPremios*15/100;
		
		$repartirPremios=$repartirPremios-$tercerPremio;
		
		$cuartoPremio=$repartirPremios*10/100;
		
		$repartirPremios=$repartirPremios-$cuartoPremio;
		
		$quintoPremio=$repartirPremios*5/100;
		
		$repartirPremios=$repartirPremios-$quintoPremio;
		

		// var_dump($repartirPremios);
		
		while($cont < $numeroApuestas){
			$apuestaID=$idApuesta[$cont];
			$numeros=$aciertos[$cont];
			$acierto=$numeros[0];
			$complemento=$numeros[1];
			$reintegro=$numeros[2];
			$numero_categoriaPremio=0;
			if($acierto>=3){
				if($acierto==6){
					$numero_categoriaPremio=$acierto;
					$primerPremio;
					$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio', IMPORTE_PREMIO='$primerPremio' WHERE napuesta='$apuestaID'";
					$conexion->exec($actualizar);
				}
				if($acierto==5){
					if($complemento==1 && $acierto==5){
						$numero_categoriaPremio=$acierto."C";
						if($reintegro==1 && $numero_categoriaPremio=="5C"){
							$numero_categoriaPremio=$numero_categoriaPremio."R";
							$segundoPremio;
							$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio', IMPORTE_PREMIO='$segundoPremio' WHERE napuesta='$apuestaID'";
							$conexion->exec($actualizar);
						}
						else{
							$numero_categoriaPremio=$acierto."C";
							$segundoPremio;
							$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio', IMPORTE_PREMIO='$segundoPremio' WHERE napuesta='$apuestaID'";
							$conexion->exec($actualizar);
						}
					}
					else{
					$numero_categoriaPremio=$acierto;
					$tercerPremio;
					$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio', IMPORTE_PREMIO='$tercerPremio' WHERE napuesta='$apuestaID'";
					$conexion->exec($actualizar);
					}
				}
				
				if($acierto==4){
					$numero_categoriaPremio=$acierto;
					$cuartoPremio;
					$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio', IMPORTE_PREMIO='$cuartoPremio' WHERE napuesta='$apuestaID'";
					$conexion->exec($actualizar);
				}
				if($acierto==3){
					$numero_categoriaPremio=$acierto;
					$quintoPremio;
					$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio', IMPORTE_PREMIO='$quintoPremio' WHERE napuesta='$apuestaID'";
					$conexion->exec($actualizar);
				}
			}
			else if($reintegro==1){
				$numero_categoriaPremio="R";
				$reintegro=1;
				$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio', IMPORTE_PREMIO='$reintegro' WHERE napuesta='$apuestaID'";
				$conexion->exec($actualizar);
			}
			else{
				$numero_categoriaPremio=0;
				$premio=0;
				
				$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio', IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
				$conexion->exec($actualizar);
			}
			$cont++;
			$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
			$conexion->exec($actualizar);

			// var_dump($apuestaID);
			// var_dump($acierto);
			// var_dump($numero_categoriaPremio);
		}
	}
	catch(PDOException $e){
		echo "Error aciertos"."<br>";
		echo $e->getMessage();
	}	
}

function actualizarSaldosPremiados($conexion){
	
}

function finalizarSorteo($conexion,$SorteoActivo){
	try{
		$actualizar= "UPDATE sorteo SET activo='N' WHERE nSorteo='$SorteoActivo'";
		$conexion->exec($actualizar);
	}
	catch(PDOException $e){
			echo "Error finalizarSorteo"."<br>";
			echo $e->getMessage();
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES AUXILIARES
////////////////////////////////////////////////////////////////////////////////////////////////

function aciertos($conexion,$SorteoActivo,$combinacionGanadora){
	try {
		$apuestas=apuestasSorteo($conexion,$SorteoActivo);
		$numeroApuestas=count($apuestas);
		$cont=0;
		
		//var_dump($apuestas);
		
		$aciertos=array();
		while($cont < $numeroApuestas){
			$apuesta=$apuestas[$cont];
			$acierto=comprobarAciertos($apuesta,$combinacionGanadora);
			array_push($aciertos,$acierto);
			$cont++;
		}
		//var_dump($aciertos);
		return $aciertos;
	}
	catch(PDOException $e){
		echo "Error aciertos"."<br>";
		echo $e->getMessage();
	}	
}
function comprobarAciertos($apuesta,$combinacionGanadora){
		$reintegroA=array_pop($apuesta);
		$complementoA=array_pop($apuesta);
		// $combinacionPrueba=array("10","20","4","40","44","46","45","6");
		// $reintegroB=array_pop($combinacionPrueba);
		// $complementoB=array_pop($combinacionPrueba);
		$reintegroB=array_pop($combinacionGanadora);
		$complementoB=array_pop($combinacionGanadora);
		$cont=0;
		$c=0;
		$r=0;
	
		foreach ($apuesta as $indice => $valor) {
			$num=$valor;
			if(in_array($num,$combinacionGanadora)){
				$cont++;
			}
			// if(in_array($num,$combinacionPrueba)){
				// $cont++;
			// }
		}
		if($complementoA==$complementoB){
			$c++;
		}
		if($reintegroA==$reintegroB){
			$r++;
		}
		
		
		$aciertos=array($cont,$c,$r);
		//var_dump($aciertos);
		return $aciertos;
}
function apuestasSorteo($conexion,$SorteoActivo){
	try {
		$select = $conexion->prepare("select n1,n2,n3,n4,n5,n6,c,r from apuestas where nsorteo='$SorteoActivo'");	 
		$select->execute();
		
		$resultado= $select->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
		
	}
	catch(PDOException $e){
		echo "Error apuestasSorteo"."<br>";
		echo $e->getMessage();
	}	
}
function idAPUESTA($conexion,$SorteoActivo){
	try {
		$select = $conexion->prepare("select napuesta from apuestas where nsorteo='$SorteoActivo'");	 
		$select->execute();
		
		$resultado = $select->fetchAll(PDO::FETCH_COLUMN, 0);  
		return $resultado;
		
	}
	catch(PDOException $e){
		echo "Error idAPUESTA"."<br>";
		echo $e->getMessage();
	}	
}
function añadirCombinacion($conexion,$SorteoActivo,$combinacionGanadora){
	try{
		$combinacion="";
		foreach ($combinacionGanadora as $indice => $valor){
			if($indice!=8){
				$numero=strval($valor);
				$combinacion.=$numero." ";
			}
		}
		$actualizar= "UPDATE sorteo SET COMBINACION_GANADORA ='$combinacion' WHERE nSorteo='$SorteoActivo'";
		$conexion->exec($actualizar);
		//var_dump($combinacion);
	}
	catch(PDOException $e){
			echo "Error añadirCombinacion"."<br>";
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
function recaudacionTotal($conexion,$SorteoActivo){
	try{
		$consulta=$conexion->prepare("select recaudacion from sorteo where nsorteo='$SorteoActivo'");
		$consulta->execute();
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;			
	}
	catch(PDOException $e){
			echo "Error recaudacionTotal"."<br>";
			echo $e->getMessage();
	}
}
function sorteos($conexion,$dni){
	try {
		//$select = $conexion->prepare("SELECT NSORTEO FROM sorteo WHERE activo='S'");
		$select = $conexion->prepare("SELECT NSORTEO FROM sorteo");
		$select->execute();
			
		$resultado= $select->fetchAll(PDO::FETCH_ASSOC);
		
		return $resultado;
		
		}
		catch(PDOException $e){
			echo "Error sorteos"."<br>";
			echo $e->getMessage();
		}
	}
function consultarBote($conexion,$SorteoActivo){
	try{
		$consulta=$conexion->prepare("select RECAUDACION_PREMIOS from sorteo where nsorteo='$SorteoActivo'");
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
