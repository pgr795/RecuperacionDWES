<?php
	include 'apiRedsys.php';
	//var_dump($_POST);
	// Se incluye la librería
	
	// Se crea Objeto
	$miObj = new RedsysAPI;
	//Valores del formulario
	
	$titular="Pablo Garcia";//_POST
	$negocio="Primitiva";
	// Valores de entrada que no hemos cmbiado para ningun ejemplo
	$fuc="999008881";
	$terminal="1";
	$moneda="978";
	$trans="0";
	$url="";
	$urlOKKO="http://localhost/Asignaturas/DWES/Pasarela/RecepcionaPet.php";
	
	$id=time();
	$amount=$_POST['saldo'];
	//floatval($_POST["saldo"]);	
	
	// Se Rellenan los campos
	$miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);//Importe*
	$miObj->setParameter("DS_MERCHANT_ORDER",$id);//NumeroPedido*
	$miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);//Identificacion de Comercio*
	$miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);//Moneda*
	$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);//tipo Transaccion*
	$miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);//Terminal*
	
	
	$miObj->setParameter("DS_MERCHANT_TITULAR",$titular);
	$miObj->setParameter("DS_MERCHANT_MERCHANTNAME",$negocio);

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

	//4548810000000003
	//12/49
	//123
?>
<html lang="es">
<head>
</head>
<body>
<form name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" target="_blank">
<p>¿Deseas continuar?</p>
<input type="submit" value="Enviar"/>
<input type="button" value="Atras" onclick="window.location.href='registro.php'" class="btn btn-warning disabled"/>
		<input type="text" hidden name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
		<input type="text" hidden name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
		<input type="text" name="Ds_Signature" hidden value="<?php echo $signature; ?>"/></br>
		<input type="text" name="importe" hidden value="<?php echo $amount; ?>"/></br>
</form>

</body>
</html>
