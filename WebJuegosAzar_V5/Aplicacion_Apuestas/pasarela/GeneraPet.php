<?php
	session_start();

	if(empty($_POST["dni"]) || empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["email"])){
		unset($_SESSION['usuario']);
		header("Location:../views/RegistroApostante_views.php");
	}
	else{
	
	include 'apiRedsys.php';
	include_once '../db/db.php';
	include_once '../models/RegistroApostante_model.php';

	// Se incluye la librería
		if($_SERVER["REQUEST_METHOD"] == "POST") {
		$conexion=conexion();
		$dni=$_POST["dni"];
		$nombre=$_POST["nombre"];
		$apellido=$_POST["apellido"];
		$email=$_POST["email"];
		$saldo=$_POST["saldo"];
		$usuario=array($dni,$nombre,$apellido,$email,$saldo);
		$_SESSION['usuario']=$usuario;
		$respuesta=comprobarDNI($conexion,$dni);
		var_dump($_SESSION);
			if($respuesta==0 ){
				registroApostante($conexion,$dni,$nombre,$apellido,$email,$saldo);
			}
			else if($respuesta==1){
				echo "Este usuario ya esta registrado";
			}
		}

	var_dump($_POST);
		
	// Se crea Objeto
	$miObj = new RedsysAPI;
	//Valores del formulario
	
	$titular=$nombre." ".$apellido;//_POST
	$negocio="Primitiva";
	// Valores de entrada que no hemos cmbiado para ningun ejemplo
	$fuc="999008881";
	$terminal="1";
	$moneda="978";
	$trans="0";
	$url="";
	$urlOKKO="http://127.0.0.1/Asignaturas/DWES/MVC/WebJuegosAzar/Aplicacion_Apuestas/pasarela/RecepcionaPet.php";
	
	$id=time();
	
	$enteroOdecimal=stripos($saldo,".");
	if($enteroOdecimal==false){
		$saldo=intval($_POST['saldo']);
		$cantidad=strlen($saldo)+2; 
		$amount=str_pad($saldo,$cantidad,"0",STR_PAD_RIGHT);
		var_dump($amount);
	}
	else{
		$saldo=str_replace(".","",$_POST['saldo']);
		$amount=str_pad($saldo,4,"0",STR_PAD_RIGHT);
		var_dump($amount);
	}

	
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
	}
	//4548810000000003
	//12/49
	//123
?>
<html lang="es">
<head>
</head>
<body>
<form name="form" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST">	
<p>¿Deseas finalizar la operacion?</p>
<input type="submit" name="enviar" value="Enviar"/>
<input type="button" value="Atras" onclick="window.location.href='../controllers/RegistroApostante_controllers.php'" class="btn btn-warning disabled"/>
		<input type="text" hidden name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
		<input type="text" hidden name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
		<input type="text" name="Ds_Signature" hidden value="<?php echo $signature; ?>"/></br>
</form>

</body>
</html>
