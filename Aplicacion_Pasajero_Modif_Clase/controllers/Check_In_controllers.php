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
	
		if(!empty($idVuelo)){
			$asiento=asientos($conexion,$idVuelo);
			var_dump($asiento);
			// $idBooking=idBooking($conexion,$idVuelo,$idUsuario);
			// if($idBooking!=null){
				// $idBooking=$idBooking[0];
				// var_dump($idBooking);
				// asignarAsientos($conexion,$idBooking,$idUsuario,$asiento);
				// echo "Check In Realizado";
			// }
		}
		else{
			echo "No hay vuelos para realizar la operacion";
		}
	}
// var_dump($_POST);

	function asientos($conexion,$idVuelo){
		var_dump($idVuelo);
		$capacidad=capacityVuelo($conexion,$idVuelo); //6
		$capacidad=intval($capacidad[0]);
		var_dump($capacidad);
		$configuracion=6;
		$fila=$capacidad/$configuracion;
		$fila=round($fila,PHP_ROUND_HALF_UP);//1
		var_dump($fila);
		$asientos=rand(1,$fila);
		var_dump($asientos);
		$limiteLetra=65+$capacidad;
		var_dump($limiteLetra);
		$letra=chr(rand(65,$limiteLetra));
		$asientoAsignado=$asientos.$letra;
		return $asientoAsignado;
	}
	
	
	
	
	
?>



