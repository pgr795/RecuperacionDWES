<?php	
session_start();
	if(!isset($_SESSION['email']) && !isset($_SESSION['nombre']) && !isset($_SESSION['id'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['nombre']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
		header("Location:../index.php");
	}
	include_once '../db/db.php';
	include_once '../models/Check_In_model.php';
	include_once '../views/Check_In_views.php';
	
	$conexion=conexion();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {	
		$idVuelo=$_POST["idVuelo"];
		$fecha=date('Y-m-d H:i:s');
		$idUsuario=$_SESSION['id'];
		$valido=true;
		$idAirplane=idAirplane($conexion,$idVuelo);
		$idAirplane=$idAirplane[0];
		$capacidad=capacityVuelo($conexion,$idAirplane);
		$capacidad=intval($capacidad[0]);
		$contador=0;
		// var_dump($capacidad);
		if(!empty($idVuelo)){
				$contador=contVuelo($conexion,$idVuelo);
				$contador=intval($contador[0]);
				if($contador!=$capacidad){	
					while($valido){
						$asiento=asientos($conexion,$idVuelo);
						$comprobar=comprobarAsiento($conexion,$idUsuario,$idVuelo,$asiento);
						// var_dump($comprobar);
						if($comprobar==null){
							$valido=false;
						}
						else if($comprobar==false){
							$valido=false;
						 }
						// var_dump($asiento);
						// var_dump($valido);
					}
					// var_dump($asiento);
					$idBooking=idBooking($conexion,$idVuelo,$idUsuario);
					// var_dump($idBooking);
					if($idBooking!=null){
						$idBooking=$idBooking[0];
						// var_dump($idBooking);
						asignarAsientos($conexion,$idBooking,$idUsuario,$asiento);
						echo "Check In Realizado";
					}
					// var_dump($valido);
				}
				else{
					echo "El avion ya llegado a su capacidad";
				}
		}
		else{
			echo "No hay vuelos para realizar la operacion";
		}
		// var_dump($_POST);
	}

	function asientos($conexion,$idVuelo){
		// var_dump($idVuelo);
		$idAirplane=idAirplane($conexion,$idVuelo);
		$idAirplane=$idAirplane[0];
		$capacidad=capacityVuelo($conexion,$idAirplane); //6
		$capacidad=intval($capacidad[0]);
		// var_dump($capacidad);
		$configuracion=6;
		
		$aux=$capacidad%$configuracion;//117%6=3 
		// En caso que sobre asientos 
		if($aux!=0){
				$fila=$capacidad/$configuracion;
				$fila=round($fila,0,PHP_ROUND_HALF_UP);//19
				
				//TotalDeFilas
				$totalDeFilas=$fila+1; //20
				
				//Fila Aleatorio
				$filaAsignada=rand(1,$fila); 
				
				//Si la fila asignada aleatoriamente es igual que el ultimo
				if($filaAsignada==strlen($totalDeFilas)){
					$limiteLetra=65+$aux-1;
					// var_dump($limiteLetra);
					$letraAleatorio=chr(rand(65,$limiteLetra-1));
					$asientoAsignado=$filaAsignada.$letraAleatorio;
					// var_dump($filaAsignada);
					return $asientoAsignado;
				}
				else if($filaAsignada!=strlen($totalDeFilas)){
					$limiteLetra=65+$configuracion;
					// var_dump($limiteLetra);
					$letraAleatorio=chr(rand(65,$limiteLetra-1));
					$asientoAsignado=$filaAsignada.$letraAleatorio;
					return $asientoAsignado;
				}	
		}
		//En caso que no sobre asientos
		else if($aux==0){
			$fila=$capacidad/$configuracion;
			$fila=round($fila,0,PHP_ROUND_HALF_UP);//1
			$filaAsignada=rand(1,$fila); 
			$limiteLetra=65+$configuracion;
			$letra=chr(rand(65,$limiteLetra-1));
			$asientoAsignado=$filaAsignada.$letra;
			return $asientoAsignado;
		}
	}
	
	//		A	B	C 	D	E	F
	//	1
	//	2
	//	3
	//	4	
?>



