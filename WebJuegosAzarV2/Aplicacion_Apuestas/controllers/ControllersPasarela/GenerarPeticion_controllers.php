<?php	
	
	// Se incluye la librería
	include_once 'apiRedsys.php';
	
	//El comercio debe decidir si la importación desea hacerla con la función “include” o “required”, según los desarrollos realizados.
	
	
	//Sacar los datos del formulario para introducirlo abajo
	
	
	// Se crea Objeto
	$miObj = new RedsysAPI; //Crea el objeto para hacer las transaccion
	
	$fuc="999008881"; //Numero del comercio
	$terminal="1"; // Numero de la terminal del banco, en este caso daria igual '001'
	$moneda="978"; //Codigo de la moneda Euro
	$trans="0"; //Codigo de transferncia autorizada
	//Cambiar el nombre para usar la final
	$url=""; //fichero destino con $_POST
	//fichero destino con $_POST
	$urlOKKO="http://127.0.0.1/Asignaturas/DWES/MVC/WebJuegosAzar/Aplicacion_Apuestas/controllers/RecibirPeticion_controllers.php";
	
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
	
	
	
	//Datos de configuración
	$version="HMAC_SHA256_V1";
    $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
    // Se generan los parámetros de la petición
    $request = "";
    $params = $miObj->createMerchantParameters();
    $signature = $miObj->createMerchantSignature($kc);		
	

?>