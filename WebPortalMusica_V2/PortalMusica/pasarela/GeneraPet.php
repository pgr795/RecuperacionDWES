<?php
		session_start();
		include_once '../db/db.php';
		include_once '../models/Descargas_model.php';
		$conexion=conexion();
		
		// Se incluye la librería
		include 'apiRedsys.php';
		// Se crea Objeto
		$miObj = new RedsysAPI;
		
		//MisVariables
		$nombre=$_SESSION["nombre"];
		$negocio="SPOTYFY";
		$titular=$nombre;
		$customerId=$_SESSION['id'];
		$invoiceId=$_SESSION['invoiceId'];
		unset($_SESSION['invoiceId']);
		$precio=precioTotal($conexion,$invoiceId);
		$precio=$precio[0];
		$enteroOdecimal=stripos($precio,".");
		var_dump($enteroOdecimal);
		var_dump($precio);
//Con el codigo de abajo no me deja hacer lo que me comentaste

// if($_SERVER["REQUEST_METHOD"] == "POST") {	
	// $Enviar=$_POST["enviar"];
	// if(isset($Enviar)){
	
	
		$_SESSION["precio"]=$precio;
		if($enteroOdecimal==false){
			$precio=intval($_SESSION["precio"]);
			$cantidad=strlen($precio)+2; 
			$amount=str_pad($precio,$cantidad,"0",STR_PAD_RIGHT);
		}
		else{
			$precio=str_replace(".","",$_SESSION["precio"]);
			$amount=str_pad($precio,3,"0",STR_PAD_RIGHT);
			
		}
			// Valores de entrada que no hemos cambiado para ningun ejemplo
			$fuc="999008881";
			$terminal="1";
			$moneda="978";
			$trans="0";
			$url="";
			//$urlOKKO="http://127.0.0.1/Asignaturas/DWES/MVC/WebPortalMusica_V2/PortalMusica/pasarela/RecepcionaPet.php";
			$urlOKKO="http://192.168.206.222/REC/Pablo%20Garcia/WebPortalMusica_V2/PortalMusica/pasarela/RecepcionaPet.php";
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
		// }
// }

	//4548810000000003
	//12/49
	//123

?>

<html lang="es">
<head>
</head>
<body>
<form name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" >
<p>¿Deseas finalizar la operacion?</p>
<input type="text" hidden name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
<input type="text" hidden name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
<input type="text" hidden name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
<input type="submit" name="enviar" value="Enviar" >
<input type="button" value="Atras" onclick="window.location.href='../controllers/Menu_Pasajero_controllers'" class="btn btn-warning disabled"/>

</form>
</body>
</html>
<?php

?>
