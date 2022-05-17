<?php
	session_start();
	if(!isset($_SESSION['id']) && !isset($_SESSION['nombre']) && !isset($_SESSION['company'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['company']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
	}
	include_once '../db/db.php';
	include_once '../models/Descargas_model.php';
	include_once '../views/Descargas_views.php';
	
	$conexion=conexion();
	
	// if($_SERVER["REQUEST_METHOD"] == "POST") {	
		// $accion=$_POST["accion"];
		// $idVuelo=$_POST["idVuelo"];
		// $idUsuario=$_SESSION['id'];
		
		// if($accion=="Agregar Vuelo"){
				// if(!empty($idVuelo)){
					// if(!isset($_SESSION["VuelosReservados"])){
						// $airplaneID=airplaneID($conexion,$idVuelo);
						// $airplaneID=$airplaneID[0];
						// $maxCapacity=capacityVuelo($conexion,$airplaneID);
						// $maxCapacity=intval($maxCapacity[0]);
						// $contVuelos=contVuelo($conexion,$idVuelo);
						// $contVuelos=intval($contVuelos[0]);
						// if($maxCapacity!=$contVuelos){
							// $vueloReservado=array(intval($idVuelo));
							// $_SESSION["VuelosReservados"]=$vueloReservado;
							// $vuelos=$_SESSION["VuelosReservados"];
							// $vuelo=datosVuelo($conexion,$vueloReservado[0]);
							// mostrarVueloSeleccionado($vuelo);
						// }
						// else{
							// echo "<br>";
							// echo "<h2 style='color:gray;'>Todos los asientos de este vuelo estan reservados</h2>";
							// echo "<br>";
						// }
					// }
					// else{
						// $airplaneID=airplaneID($conexion,$idVuelo);
						// $airplaneID=$airplaneID[0];
						// $maxCapacity=capacityVuelo($conexion,$airplaneID);
						// $maxCapacity=intval($maxCapacity[0]);
						// $contVuelos=contVuelo($conexion,$idVuelo);
						// $contVuelos=intval($contVuelos[0]);
						// if($maxCapacity!=$contVuelos){
							// $vueloReservado=intval($idVuelo);
							// $listaVuelos=$_SESSION["VuelosReservados"];
							// $repetido=comprobarVuelos($conexion,$listaVuelos,$vueloReservado);
							// if($repetido){
								// array_push($_SESSION["VuelosReservados"],$vueloReservado);
								// $vuelos=$_SESSION["VuelosReservados"];
								// foreach ($vuelos as $indice => $valor) {
									// $vuelo=datosVuelo($conexion,$valor);
									// mostrarVueloSeleccionado($vuelo);
								// }
							// }
							// else{
								// echo "<br>";
								// echo "<h2 style='color:gray;'>No puedes repetir este vuelo </h2>";
								// echo "<br>";
							// }	
						// }
						// else{
							// echo "<br>";
							// echo "<h2 style='color:gray;'>Todos los asientos de este vuelo estan reservados</h2>";
							// echo "<br>";
						// }
					// }
				// }
				// else{
					// echo "<br>";
					// echo "<h2 style='color:gray;'>No has seleccionado ningun vuelo </h2>";
					// echo "<br>";
				// }
		// }
		// else if($accion=="Finalizar Reserva"){
				// if(isset($_SESSION["VuelosReservados"])){
						// $vuelosReservados=$_SESSION["VuelosReservados"];
						// $passenger_id=$_SESSION['id'];
						// header('Location:../pasarela/GeneraPet.php');
				// }
				// else{
					// echo "<br>";
					// echo "<h2 style='color:gray;'>No has reservado ningun vuelo</h2>";
					// echo "<br>";
				// }	
		// }
		// else if($accion=="Borrar Vuelos"){
			// if(isset($_SESSION["VuelosReservados"])){
				// unset($_SESSION["VuelosReservados"]);
				// echo "<br>";
				// echo "<h2 style='color:gray;'>Los vuelos seleccionados han sido eliminados</h2>";
				// echo "<br>";
			// }
			// else{
				// echo "<br>";
				// echo "<h2 style='color:gray;'>No hay vuelos para eliminar</h2>";
				// echo "<br>";
			// }
		// }
	// }

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES 
////////////////////////////////////////////////////////////////////////////////////////////////
// function comprobarVuelos($conexion,$listaVuelos,$vueloReservado){
	// $valido=true;
	// if(in_array($vueloReservado,$listaVuelos)){
		// $valido=false;
	// }
	// return $valido;
// }
?>