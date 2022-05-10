<?php
	
// Nueva Funcionalidad
// Modificar Asiento: permita seleccionar al pasajero una reserva en la que ya se ha realizado el check-in (ya tiene un asiento asignado) y le permita seleccionar cualquier otro asiento disponible del avión. Se le mostrará una lista de todos los asientos disponibles

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
	include_once '../models/Modificar_Asiento_model.php';
	include_once '../views/Modificar_Asiento_views.php';
	
	$conexion=conexion();

	if($_SERVER["REQUEST_METHOD"] == "POST") {	
		$idVuelo=$_POST["idVuelo"];
		$idUsuario=$_SESSION["id"];
		$accion=$_POST["accion"];
		$idVuelo=intval($idVuelo);

		$asientoActual=asientoActual($conexion,$idVuelo,$idUsuario);
		$asientoActual=$asientoActual[0];
	
		if($accion=="Asiento actual"){
			if(!empty($idVuelo)){
				echo "<h2 class='card-body' align='center' style='color:gray;'>Asiento Actual: ".$asientoActual."</h2>";
			}
		}
		else if($accion=="Modificar Asiento"){
			if(!empty($_POST["asiento"])){
				$cambiarAsiento=$_POST["asiento"];
				actualizarAsiento($conexion,$cambiarAsiento,$asientoActual,$idVuelo,$idUsuario);
			}
			else{
				echo "<h2 class='card-body' align='center' style='color:gray;'>Todos los asientos estan ocupados o no has seleccionado un asiento disponible</h2>";
			}
			}
		else if($accion=="Asientos disponibles"){
				$idAirplane=idAirplane($conexion,$idVuelo);
				$idAirplane=$idAirplane[0];
				$capacidad=capacityVuelo($conexion,$idAirplane);
				$capacidad=intval($capacidad[0]);
				$Aux=CalcularAsientos($conexion,$idVuelo);
				$asientosAvion=AsientosAvion($conexion,$Aux);
				
				$asientosAvionOcupados=AsientosAvionOcupados($conexion,$idVuelo,$capacidad);
				$asientosDisponibles=array_diff($asientosAvion,$asientosAvionOcupados);
				mostrarAsientosDisponibles($asientosDisponibles);
		}
	}
	
////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES 
////////////////////////////////////////////////////////////////////////////////////////////////

function AsientosAvion($conexion,$AsientosAvion){
		$aux=array();
		foreach($AsientosAvion as $indice => $consulta){
			$indice+=1;
			foreach($consulta as $consulta2){
				array_push($aux,"$indice$consulta2");
			}
		}
		return $aux;
}
function mostrarAsientosDisponibles($asientosAvion){
		echo "<B class='card-body'>Asientos Disponibles: <BR><BR>";
		echo "<select form='asiento' id='asiento' name='asiento'>";
				foreach($asientosAvion as $indice => $consulta){
					echo '<option value="'.$consulta.'">'.$consulta.'</option>';
				}
		echo "</select>";
}
function CalcularAsientos($conexion,$idVuelo){
		$idAirplane=idAirplane($conexion,$idVuelo);
		$idAirplane=$idAirplane[0];
		$capacidad=capacityVuelo($conexion,$idAirplane); 
		$capacidad=intval($capacidad[0]);
		$configuracion=6;
		
		//Calculas si te van a sobrar asientos
		$aux=$capacidad%$configuracion;
		
		//Si sobran asientos
		if($aux!=0){
				$fila=$capacidad/$configuracion;
				$fila=round($fila,0,PHP_ROUND_HALF_UP);
				$totalDeFilas=intval($fila+1); 
				
				//Filas
				$Filas=$totalDeFilas-1;
				$asientos=array("A","B","C","D","E","F");
				$asientosTotal=array();
				for ($i = 0; $i < $Filas; $i++) {
					array_push($asientosTotal,$asientos);
				}

				//Fila extra
				$ultimaFila = array_slice($asientos,0,$aux);  
				array_push($asientosTotal,$ultimaFila);
				
				return $asientosTotal;		
		}
		//En caso que no sobren asientos
		else if($aux==0){
				$fila=$capacidad/$configuracion;
				$fila=round($fila,0,PHP_ROUND_HALF_UP);
				$totalDeFilas=intval($fila); 
				
				$asientos=array("A","B","C","D","E","F");
				$asientosTotal=array();
				for ($i = 0; $i < $totalDeFilas; $i++) {
					array_push($asientosTotal,$asientos);
				}
				return $asientosTotal;
		}
	}


		