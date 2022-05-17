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
	include_once '../models/Consultar_Facturas_model.php';
	include_once '../views/Consultar_Facturas_views.php';	
	
	$conexion=conexion();
	
	// if($_SERVER["REQUEST_METHOD"] == "POST") {
		// $nombre=$_POST["nombre"];
		// $nacimiento=$_POST["cumple"];
		// $sexo=$_POST["sex"];	
		// $calle=$_POST["calle"];
		// $ciudad=$_POST["ciudad"];	
		// $cp=$_POST["codigoPostal"];	
		// $pais=$_POST["pais"];
		// $email=$_POST["email"];
		// $telefono=$_POST["telefono"];	
		// $respuesta=comprobarPasajero($conexion,$email,$nacimiento);
		// if($respuesta==null){
					// $idParaAsignar=idPasajero($conexion);
					// insertPasajero($conexion,$idParaAsignar,$nombre,$nacimiento,$sexo,$calle,$ciudad,$cp,$pais,$email,$telefono);
		// }
		// else{
			// echo "Pasajero ya existe"."<br>";
		// }
	// }
?>
