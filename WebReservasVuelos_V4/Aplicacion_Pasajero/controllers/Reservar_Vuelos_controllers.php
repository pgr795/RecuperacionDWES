<?php
	session_start();
	// var_dump($_SESSION);
	if(!isset($_SESSION['email']) && !isset($_SESSION['nombre']) && !isset($_SESSION['id'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['nombre']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
		header("Location:../index.php");
	}

	include_once '../db/db.php';
	include_once '../models/Reservar_Vuelos_model.php';
	include_once '../views/Reservar_Vuelos_views.php';
	
	$conexion=conexion();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {	
		
		$accion=$_POST["accion"];
		$idVuelo=$_POST["idVuelo"];
		$idUsuario=$_SESSION['id'];
		
		if($accion=="Agregar Vuelo"){
				if(!empty($idVuelo)){
					if(!isset($_SESSION["VuelosReservados"])){
						$airplaneID=airplaneID($conexion,$idVuelo);
						$airplaneID=$airplaneID[0];
						$maxCapacity=capacityVuelo($conexion,$airplaneID);
						$maxCapacity=intval($maxCapacity[0]);
						$contVuelos=contVuelo($conexion,$idVuelo);
						$contVuelos=intval($contVuelos[0]);
						if($maxCapacity!=$contVuelos){
							$vueloReservado=array(intval($idVuelo));
							$_SESSION["VuelosReservados"]=$vueloReservado;
							$vuelos=$_SESSION["VuelosReservados"];
							$vuelo=datosVuelo($conexion,$vueloReservado[0]);
							mostrarVueloSeleccionado($vuelo);
						}
						else{
							echo "<br>";
							echo "<h2 style='color:gray;'>Todos los asientos de este vuelo estan reservados</h2>";
							echo "<br>";
						}
					}
					else{
						$airplaneID=airplaneID($conexion,$idVuelo);
						$airplaneID=$airplaneID[0];
						$maxCapacity=capacityVuelo($conexion,$airplaneID);
						$maxCapacity=intval($maxCapacity[0]);
						$contVuelos=contVuelo($conexion,$idVuelo);
						$contVuelos=intval($contVuelos[0]);
						if($maxCapacity!=$contVuelos){
							$vueloReservado=intval($idVuelo);
							$listaVuelos=$_SESSION["VuelosReservados"];
							$repetido=comprobarVuelos($conexion,$listaVuelos,$vueloReservado);
							if($repetido){
								array_push($_SESSION["VuelosReservados"],$vueloReservado);
								$vuelos=$_SESSION["VuelosReservados"];
								foreach ($vuelos as $indice => $valor) {
									$vuelo=datosVuelo($conexion,$valor);
									mostrarVueloSeleccionado($vuelo);
								}
							}
							else{
								echo "<br>";
								echo "<h2 style='color:gray;'>No puedes repetir este vuelo </h2>";
								echo "<br>";
							}	
						}
						else{
							echo "<br>";
							echo "<h2 style='color:gray;'>Todos los asientos de este vuelo estan reservados</h2>";
							echo "<br>";
						}
					}
				}
				else{
					echo "<br>";
					echo "<h2 style='color:gray;'>No has seleccionado ningun vuelo </h2>";
					echo "<br>";
				}
		}
		else if($accion=="Finalizar Reserva"){
				if(isset($_SESSION["VuelosReservados"])){
						$vuelosReservados=$_SESSION["VuelosReservados"];
						$passenger_id=$_SESSION['id'];
						reservarVuelos($conexion,$vuelosReservados,$passenger_id);
						$precio=precioTotalVuelos($conexion,$passenger_id,$vuelosReservados);
						$_SESSION["precio"]=$precio;
						unset($_SESSION["VuelosReservados"]);
						header('Location:../pasarela/GeneraPet.php');
				}
				else{
					echo "<br>";
					echo "<h2 style='color:gray;'>No has reservado ningun vuelo</h2>";
					echo "<br>";
				}	
		}
		else if($accion=="Borrar Vuelos"){
			if(isset($_SESSION["VuelosReservados"])){
				unset($_SESSION["VuelosReservados"]);
				echo "<br>";
				echo "<h2 style='color:gray;'>Los vuelos seleccionados han sido eliminados</h2>";
				echo "<br>";
			}
			else{
				echo "<br>";
				echo "<h2 style='color:gray;'>No hay vuelos para eliminar</h2>";
				echo "<br>";
			}
		}
	}
	// var_dump($_SESSION);
	
////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES 
////////////////////////////////////////////////////////////////////////////////////////////////
function reservarVuelos($conexion,$vuelosReservados,$passenger_id){
	foreach($vuelosReservados as $indice => $valor){
		$idFlight=$valor;
		$idAirplane=airplaneID($conexion,$idFlight);
		$idAirplane=$idAirplane[0];
		$idBooking=maxIdBooking($conexion);
		$seat=null;
		$capacity=capacityVuelo($conexion,$idAirplane);
		$capacity=intval($capacity[0]);
		$price=precioVuelo($conexion,$capacity);
		insertBooking($conexion,$idBooking,$idFlight,$seat,$passenger_id,$price);
		// var_dump($vuelo); // var_dump($idAirplane); // var_dump($idBooking); // var_dump($capacity); var_dump($vuelosReservados);// var_dump($price);
	}
}
function precioVuelo($conexion,$capacity){
	$precio=0;
	if($capacity<=100){
		$precio=80;
	}
	else if($capacity>100 && $capacity<200){
		$precio=120;
	}
	else if($capacity>=300){
		$precio=300;
	}
	return $precio;
}
function precioTotalVuelos($conexion,$passenger_id,$vuelosReservados){
	$totalPrecio=0;
	foreach($vuelosReservados as $indice => $valor){
		$idFlight=$valor;
		$precio=precioPorVuelo($conexion,$idFlight,$passenger_id);
		$precio=intval($precio[0]);
		$totalPrecio+=intval($precio);
	}
	return $totalPrecio;
}
function comprobarVuelos($conexion,$listaVuelos,$vueloReservado){
	$valido=true;
	if(in_array($vueloReservado,$listaVuelos)){
		$valido=false;
	}
	return $valido;
}


?>
