<?php
	session_start();
	// Se incluye la librería
	
	if(!isset($_SESSION['email']) && !isset($_SESSION['nombre']) && !isset($_SESSION['id'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['nombre']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
		header("Location:../index.php");
	}
	
	include 'apiRedsys.php';
	include_once '../models/Reservar_Vuelos_model.php';
	include_once '../db/db.php';
	
	$conexion=conexion();
	
	// Se crea Objeto
		$miObj = new RedsysAPI;	
		
		$conexion->beginTransaction();
		reservaVuelos();
		$conexion->commit();
		$passenger_id=$_SESSION['id'];
		$vuelosReservados=$_SESSION['VuelosReservados'];
		transaccion($conexion,$vuelosReservados,$passenger_id);
		$precio=precioTotalVuelos($conexion,$passenger_id,$vuelosReservados);
		$nombre=$_SESSION["nombre"];
		$_SESSION["precio"]=$precio;
		$negocio="Viajes.SL";
		$titular=$nombre;
		$enteroOdecimal=stripos($precio,".");
		
		var_dump($_SESSION);
		
		if($enteroOdecimal==false){
			$precio=intval($_SESSION["precio"]);
			$cantidad=strlen($precio)+2; 
			$amount=str_pad($precio,$cantidad,"0",STR_PAD_RIGHT);
			var_dump($amount);
		}
		else{
			$precio=str_replace(".","",$_SESSION["precio"]);
			$amount=str_pad($precio,4,"0",STR_PAD_RIGHT);
			var_dump($amount);
		}
		
		// Valores de entrada que no hemos cmbiado para ningun ejemplo
		$fuc="999008881";
		$terminal="1";
		$moneda="978";
		$trans="0";
		$url="";
		//$urlOKKO="http://127.0.0.1/Asignaturas/DWES/MVC/WebReservasVuelos/Aplicacion_Pasajero/pasarela/RecepcionaPet.php";
		$urlOKKO="http://192.168.206.222/REC/Pablo%20Garcia/WebReservasVuelos_V3/Aplicacion_Pasajero/pasarela/RecepcionaPet.php";
		$id=time();
		
		// Se Rellenan los campos
		$miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
		$miObj->setParameter("DS_MERCHANT_ORDER",$id);
		$miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
		$miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
		$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
		$miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
		$miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
		$miObj->setParameter("DS_MERCHANT_URLOK",$urlOKKO);
		$miObj->setParameter("DS_MERCHANT_URLKO",$urlOKKO);
		$miObj->setParameter("DS_MERCHANT_TITULAR",$titular);
		$miObj->setParameter("DS_MERCHANT_MERCHANTNAME",$negocio);
		//Datos de configuración
		$version="HMAC_SHA256_V1";
		$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
		// Se generan los parámetros de la petición
		$request = "";
		$params = $miObj->createMerchantParameters();
		$signature = $miObj->createMerchantSignature($kc);
		//target="_blank"
	

////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES RESERVARVUELOS
////////////////////////////////////////////////////////////////////////////////////////////////
// function transaccion($conexion,$vuelosReservados,$passenger_id){
	// try{
		// $conexion->beginTransaction();
		// reservarVuelos($conexion,$vuelosReservados,$passenger_id);
		// $conexion->commit();
	// }
	// catch (PDOException $e) {
		// echo "Error insertar"."<br>";
			// echo $e->getMessage();
			// $e->rollback();	
	// }
// }
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

function BeginTransaction($conexion){
	$conexion->beginTransaction();
}
function Commit($conexion){
	$conexion->commit();
}
function Rollback($conexion){
	$conexion->rollback();
}


//4548810000000003
//12/49
//123
///"https://sis-t.redsys.es:25443/sis/realizarPago"
 
?>
<html lang="es">
<head>
</head>
<body>
<form name="frm" action="" method="POST" >
<p>¿Deseas finalizar la operacion?</p>
<input type="text" hidden name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
<input type="text" hidden name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
<input type="text" hidden name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
<input type="submit" value="Enviar" >
<input type="button" value="Atras" onclick="window.location.href='../controllers/Menu_Pasajero_controllers'" class="btn btn-warning disabled"/>

</form>

</body>
</html>
