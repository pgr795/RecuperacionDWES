<?php
////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCION PRINCIPAL
////////////////////////////////////////////////////////////////////////////////////////////////
function realizarSorteo($conexion,$SorteoActivo,$combinacionGanadora,$idUsuario){
	try{
		if($SorteoActivo!=null){
			añadirCombinacion($conexion,$SorteoActivo,$combinacionGanadora);
			actualizarRecaudacion($conexion,$SorteoActivo);
			actualizarAciertos($conexion,$SorteoActivo,$combinacionGanadora);
			actualizarPremios($conexion,$SorteoActivo,$combinacionGanadora);
			actualizarSaldos($conexion,$SorteoActivo,$idUsuario);
			finalizarSorteo($conexion,$SorteoActivo);
			echo "El sorteo ".$SorteoActivo." se ha cerrado";
		}
	}
	catch(PDOException $e){
			echo "Error realizarSorteo"."<br>";
			echo $e->getMessage();
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES DE REALIZAR SORTEO
////////////////////////////////////////////////////////////////////////////////////////////////
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
function actualizarRecaudacion($conexion,$SorteoActivo){
	try{
		$recaudacion=datoRecaudacion($conexion,$SorteoActivo);
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
		
		// var_dump($aciertos);
		// var_dump($idApuesta);
			while($cont < $numeroApuestas){
				$numero_categoriaPremio;
				$apuestaID=$idApuesta[$cont];
				$numeros=$aciertos[$cont];
				$acierto=$numeros[0];
				$complemento=$numeros[1];
				$reintegro=$numeros[2];
				
				// var_dump("");
				// var_dump("ID APUESTA: ".$apuestaID);
				// var_dump("Aciertos: ".$acierto);
				// var_dump("Complemento: ".$complemento);
				// var_dump("Reintegro: ".$reintegro);
				// var_dump("");
				
			if($acierto>=3){
				if($acierto==6){
					if($acierto==6 && $reintegro==1){
						$numero_categoriaPremio=$acierto."R";
						// var_dump($numero_categoriaPremio);
						$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
					else{
						$numero_categoriaPremio=$acierto;
						// var_dump($numero_categoriaPremio);
						$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
				}
				if($acierto==5){
						if($acierto==5 && $complemento==1 && $reintegro==1){
								$numero_categoriaPremio=$acierto."CR";
								// var_dump($numero_categoriaPremio);
								$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
								$conexion->exec($actualizar);
						}
						else if($acierto==5 && $complemento==1 && $reintegro==0){
								$numero_categoriaPremio=$acierto."C";
								// var_dump($numero_categoriaPremio);
								$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
								$conexion->exec($actualizar);
						}
						else if($acierto==5 && $reintegro==1){
							$numero_categoriaPremio=$acierto."R";
							// var_dump($numero_categoriaPremio);
							$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
							$conexion->exec($actualizar);
						}
						else{
							$numero_categoriaPremio=$acierto;
							// var_dump($numero_categoriaPremio);
							$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
							$conexion->exec($actualizar);
						}
				}
				
				if($acierto==4){
					if($acierto==4 && $reintegro==1){
						$numero_categoriaPremio=$acierto."R";
						// var_dump($numero_categoriaPremio);
						$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
					else{
						$numero_categoriaPremio=$acierto;
						// var_dump($numero_categoriaPremio);
						$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
				}
				if($acierto==3){
					if($acierto==3 && $reintegro==1){
						$numero_categoriaPremio=$acierto."R";
						// var_dump($numero_categoriaPremio);
						$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
					else{
						$numero_categoriaPremio=$acierto;
						// var_dump($numero_categoriaPremio);
						$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
				}
			}
			else if($reintegro==1){
				$numero_categoriaPremio="R";
				// var_dump($numero_categoriaPremio);
				$actualizar= "UPDATE apuestas SET categoria_premio='$numero_categoriaPremio' WHERE napuesta='$apuestaID'";
				$conexion->exec($actualizar);
			}
			$cont++;
		}
	}
	catch(PDOException $e){
		echo "Error actualizarAciertos"."<br>";
		echo $e->getMessage();
	}	
}
function actualizarPremios($conexion,$SorteoActivo,$combinacionGanadora){
		try {
		$aciertos=aciertos($conexion,$SorteoActivo,$combinacionGanadora);
		$idApuesta=idAPUESTA($conexion,$SorteoActivo);
		$premios=premiosRepartido($conexion,$SorteoActivo);
		$numeroApuestas=count($aciertos);
		$cont=0;
		
	
		// var_dump($aciertos);
		// var_dump($idApuesta);
		// var_dump($premios);
		
			while($cont < $numeroApuestas){
				$apuestaID=$idApuesta[$cont];
				$numeros=$aciertos[$cont];
				$acierto=$numeros[0];
				$complemento=$numeros[1];
				$reintegro=$numeros[2];
				
				// var_dump("");
				// var_dump("ID APUESTA: ".$apuestaID);
				// var_dump("Aciertos: ".$acierto);
				// var_dump("Complemento: ".$complemento);
				// var_dump("Reintegro: ".$reintegro);
				// var_dump("");
				
			if($acierto>=3){
				if($acierto==6){
					if($acierto==6 && $reintegro==1){
						$premio=$premios[6]+1;
						$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO=$premio WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
					else{
						$premio=$premios[6];
						
						$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
				}
				if($acierto==5){
						if($acierto==5 && $complemento==1 && $reintegro==1){
								$premio=$premios['5C']+1;
								$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
								$conexion->exec($actualizar);
						}
						else if($acierto==5 && $complemento==1 && $reintegro==0){
								$premio=$premios['5C'];
								$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
								$conexion->exec($actualizar);
						}
						else if($acierto==5 && $reintegro==1){
							$premio=$premios['5']+1;
							$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
							$conexion->exec($actualizar);
						}
						else{
							$premio=$premios['5'];
							$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
							$conexion->exec($actualizar);
						}
				}
				
				if($acierto==4){
					if($acierto==4 && $reintegro==1){
						$premio=$premios['4']+1;
						$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
					else{
						$premio=$premios['4'];
						$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
				}
				if($acierto==3){
					if($acierto==3 && $reintegro==1){
						$premio=$premios['3']+1;
						$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
					else{
						$premio=$premios['3'];
						$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
						$conexion->exec($actualizar);
					}
				}
			}
			else if($reintegro==1){
				$premio=1;
				$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
				$conexion->exec($actualizar);
			}
			else{
				$premio=0;
				$actualizar= "UPDATE apuestas SET IMPORTE_PREMIO='$premio' WHERE napuesta='$apuestaID'";
				$conexion->exec($actualizar);
			}
			$cont++;
			}
	}
	catch(PDOException $e){
		echo "Error actualizarAciertos"."<br>";
		echo $e->getMessage();
	}
}
function actualizarSaldos($conexion,$SorteoActivo,$idUsuario){
	try{
		$dni=idDNI($conexion,$SorteoActivo);
		
		foreach($dni as $consulta){
			$idUsuario=$consulta;
			$premios= sumPremiosGanadosDni($conexion,$SorteoActivo,$idUsuario);
			$saldo=saldoDelApostante($conexion,$SorteoActivo,$idUsuario);
			$premio=intval($premios['premio']);
			$saldo=intval($saldo['saldo']);
			$saldoActualizado=$saldo+$premio;
			// var_dump($saldoActualizado);
			
			$actualizar= "UPDATE apostante SET saldo='$saldoActualizado' WHERE dni='$idUsuario'";
			$conexion->exec($actualizar);
		}
	}
	catch(PDOException $e){
			echo "Error actualizarSaldos"."<br>";
			echo $e->getMessage();
	}
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
//FUNCIONES AÑADIR COMBINACION
////////////////////////////////////////////////////////////////////////////////////////////////
function combinacionGanadora(){
    $combinacionGanadora=array(); //Array Vacio
    $contador=0;
	$valido=true;
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
		$reintegro=reintegro();
	
	while($valido){	
		if(!in_array($reintegro,$combinacionGanadora)){
            $combinacionGanadora[7]=$reintegro;
			$valido=false;
		}
		else{
			$reintegro=reintegro();
		}
	}
	 
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

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES ACTUALIZAR RECAUDACION
////////////////////////////////////////////////////////////////////////////////////////////////
function datoRecaudacion($conexion,$SorteoActivo){
	try{
		$consulta=$conexion->prepare("select recaudacion from sorteo where nsorteo='$SorteoActivo'");
		$consulta->execute();
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;			
	}
	catch(PDOException $e){
			echo "Error datoRecaudacion"."<br>";
			echo $e->getMessage();
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES ACTUALIZAR ACIERTOS
////////////////////////////////////////////////////////////////////////////////////////////////
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
function premiosRepartido($conexion,$SorteoActivo){
	try{
		$premiosPorUno=premiosPorUnAcertante($conexion,$SorteoActivo);
		$NumeroDePremiados=nPremiados($conexion,$SorteoActivo);
		// var_dump($premiosPorUno);
		// var_dump($NumeroDePremiados);
		$P6=$NumeroDePremiados[6];
		$P5C=$NumeroDePremiados['5C'];
		$P5=$NumeroDePremiados[5];
		$P4=$NumeroDePremiados[4];
		$P3=$NumeroDePremiados[3];
		
		
		if($P6!=0){
			$P6=$premiosPorUno[6]/$NumeroDePremiados[6];
		}
		if($P5C!=0){
			$P5C=$premiosPorUno['5C']/$NumeroDePremiados['5C'];
		}
		if($P5!=0){
			$P5=$premiosPorUno[5]/$NumeroDePremiados[5];
		}
		if($P4!=0){
			$P4=$premiosPorUno[4]/$NumeroDePremiados[4];
		}
		if($P3!=0){
			$P3=$premiosPorUno[3]/$NumeroDePremiados[3];
		}
		
		$premiosRepartido=array('6'=>$P6,'5C'=>$P5C,'5'=>$P5,'4'=>$P4,'3'=>$P3);

		// var_dump($premiosRepartido);
		return $premiosRepartido;
	}
	catch(PDOException $e){
		echo "Error premiosRepartido"."<br>";
		echo $e->getMessage();
		}
}

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES AUXILIARES => FUNCION ACIERTOS
////////////////////////////////////////////////////////////////////////////////////////////////
function comprobarAciertos($apuesta,$combinacionGanadora){
		$reintegroA=array_pop($apuesta);
		$complementoA=array_pop($apuesta);
		$reintegroB=array_pop($combinacionGanadora);
		$complementoB=$reintegroB=array_pop($combinacionGanadora);
		// $combinacionPrueba=array(10,20,25,40,44,46,49,6);
		// $reintegroB=array_pop($combinacionPrueba);
		// $complementoB=array_pop($combinacionPrueba);
		// var_dump($combinacionGanadora);
		$cont=0;
		$c=0;
		$r=0;
	
		foreach ($apuesta as $indice => $valor) {
			if($indice!='c' || $indice!='r'){
				$num=intval($valor);
				if(in_array($num,$combinacionGanadora)){
					$cont++;
				}
				// if(in_array($num,$combinacionPrueba)){
					// $cont++;
				// }
			}
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

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES AUXILIARES => PREMIOSREPARTIDO
////////////////////////////////////////////////////////////////////////////////////////////////
function premiosPorUnAcertante($conexion,$SorteoActivo){
	try{
		$recaudacion=consultarBote($conexion,$SorteoActivo);//100.000

		$premioRestante;
		$repartirPremio=intval($recaudacion[0]);
		$premios=array();
	
		
	//PRIMER PREMIO
		$primerPremio=$repartirPremio*50/100; //50.000
		$primerPremio6R=$primerPremio+1;

	//PREMIO RESTANTE
		$premioRestante=$repartirPremio-$primerPremio;//100000-50000
		
	//SEGUNDO PREMIO	//5CR //5C
		$segundoPremio=$premioRestante*20/100;
		$segundoPremio5CR=$segundoPremio+1;
		
	//PREMIO RESTANTE
		$premioRestante=$premioRestante-$segundoPremio;
		
	//TERCER PREMIO //5R //5
		$tercerPremio=$premioRestante*15/100;
		$tercerPremio5R=$tercerPremio+1;
	
	//PREMIO RESTANTE
		$premioRestante=$premioRestante-$tercerPremio;
	
	//CUARTO PREMIO //4R //4
		$cuartoPremio=$premioRestante*10/100;
		$cuartoPremio4R=$cuartoPremio+1;
		
	//PREMIO RESTANTE
		$premioRestante=$premioRestante-$cuartoPremio;
		
	//QUINTO PREMIO //3R //3
		$quintoPremio=$premioRestante*5/100;
		$quintoPremio3R=$quintoPremio+1;
	
		// $premios=array('R6'=>$primerPremio6R,'6'=>$primerPremio,'5CR'=>$segundoPremio5CR,'5C'=>$segundoPremio,'5R'=>$tercerPremio5R,'5'=>$tercerPremio,'4R'=>$cuartoPremio4R,'4'=>$cuartoPremio,'3R'=>$quintoPremio3R,'3'=>$quintoPremio);
		
		$premios=array('6'=>$primerPremio,'5C'=>$segundoPremio,'5'=>$tercerPremio,'4'=>$cuartoPremio,'3'=>$quintoPremio);
		
		return $premios;
	}
	catch(PDOException $e){
		echo "Error premiosPorUnAcertante"."<br>";
		echo $e->getMessage();
		}
}
function nPremiados($conexion,$SorteoActivo){
	try {
		$P6=contCategoria6($conexion,$SorteoActivo);
		$P5C=contCategoria5C($conexion,$SorteoActivo);
		$P5=contCategoria5($conexion,$SorteoActivo);
		$P4=contCategoria4($conexion,$SorteoActivo);
		$P3=contCategoria3($conexion,$SorteoActivo);

		$nPremiados=array('6'=>intval($P6[0]),'5C'=>intval($P5C[0]),'5'=>intval($P5[0]),'4'=>intval($P4[0]),'3'=>intval($P3[0]));
		return $nPremiados;
		
	}
	catch(PDOException $e){
		echo "Error nPremiados"."<br>";
		echo $e->getMessage();
	}	
}

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES AUXILIARES => FUNCION  PREMIOS POR UN ACERTANTE
////////////////////////////////////////////////////////////////////////////////////////////////
function consultarBote($conexion,$SorteoActivo){
	try{
		$consulta=$conexion->prepare("select RECAUDACION_PREMIOS from sorteo where nsorteo='$SorteoActivo'");
		$consulta->execute();
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;			
	}
	catch(PDOException $e){
			echo "Error consultarBote"."<br>";
			echo $e->getMessage();
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES AUXILIARES => FUNCION NPREMIADOS
////////////////////////////////////////////////////////////////////////////////////////////////
function contCategoria6($conexion,$SorteoActivo){
	try {
		$select = $conexion->prepare("SELECT count(napuesta) FROM apuestas WHERE CATEGORIA_PREMIO like '6%' and NSORTEO='$SorteoActivo'");	 
		$select->execute();
		
		$resultado= $select->fetch(PDO::FETCH_NUM);
		return $resultado;
		
	}
	catch(PDOException $e){
		echo "Error contCategoria6"."<br>";
		echo $e->getMessage();
	}	
}
function contCategoria5C($conexion,$SorteoActivo){
	try {
		$select = $conexion->prepare("SELECT count(napuesta) FROM apuestas WHERE CATEGORIA_PREMIO like '5C%' and NSORTEO='$SorteoActivo'");	 
		$select->execute();
		
		$resultado= $select->fetch(PDO::FETCH_NUM);
		return $resultado;
		
	}
	catch(PDOException $e){
		echo "Error contCategoria5C"."<br>";
		echo $e->getMessage();
	}	
}
function contCategoria5($conexion,$SorteoActivo){
	try {
		$select = $conexion->prepare("SELECT count(napuesta) FROM apuestas WHERE CATEGORIA_PREMIO like '5R' OR CATEGORIA_PREMIO like '5' and NSORTEO='$SorteoActivo'");	 
		$select->execute();
		
		$resultado= $select->fetch(PDO::FETCH_NUM);
		return $resultado;
		
	}
	catch(PDOException $e){
		echo "Error contCategoria5C"."<br>";
		echo $e->getMessage();
	}	
}
function contCategoria4($conexion,$SorteoActivo){
	try {
		$select = $conexion->prepare("SELECT count(napuesta) FROM apuestas WHERE categoria_premio like '4R' OR categoria_premio like '4' and NSORTEO='$SorteoActivo'");	 
		$select->execute();
		
		$resultado= $select->fetch(PDO::FETCH_NUM);
		return $resultado;
		
	}
	catch(PDOException $e){
		echo "Error contCategoria5C"."<br>";
		echo $e->getMessage();
	}	
}
function contCategoria3($conexion,$SorteoActivo){
	try {
		$select = $conexion->prepare("SELECT count(napuesta) FROM apuestas WHERE categoria_premio like '3R' OR categoria_premio like '3' and NSORTEO='$SorteoActivo'");	 
		$select->execute();
		
		$resultado= $select->fetch(PDO::FETCH_NUM);
		return $resultado;
		
	}
	catch(PDOException $e){
		echo "Error contCategoria5C"."<br>";
		echo $e->getMessage();
	}	
}

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES ACTUALIZAR SALDOS
////////////////////////////////////////////////////////////////////////////////////////////////
function idDNI($conexion,$SorteoActivo){
	try {
		$select = $conexion->prepare("select dni from apostante");	 
		$select->execute();
		
		$resultado = $select->fetchAll(PDO::FETCH_COLUMN, 0);  
		return $resultado;
		
	}
	catch(PDOException $e){
		echo "Error idDNI"."<br>";
		echo $e->getMessage();
	}	
}
function sumPremiosGanadosDni($conexion,$SorteoActivo,$idUsuario){
	try{
		$select = $conexion->prepare("SELECT sum(importe_premio) AS premio FROM apuestas WHERE nsorteo='$SorteoActivo' AND dni='$idUsuario'");
		$select->execute();
		
		$resultado= $select->fetch(PDO::FETCH_ASSOC);
		
		return $resultado;
	}
	catch(PDOException $e){
			echo "Error: sumPremiosGanadosDni"."<br>";
			echo $e->getMessage();
	}
}
function saldoDelApostante($conexion,$SorteoActivo,$idUsuario){
	try{
		$select = $conexion->prepare("SELECT saldo FROM apostante WHERE dni='$idUsuario'");
		$select->execute();
		
		$resultado= $select->fetch(PDO::FETCH_ASSOC);
		
		return $resultado;
	}
	catch(PDOException $e){
			echo "Error saldoDelApostante"."<br>";
			echo $e->getMessage();
	}
	}

////////////////////////////////////////////////////////////////////////////////////////////////
//OTRAS FUNCIONES
////////////////////////////////////////////////////////////////////////////////////////////////
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

?>
