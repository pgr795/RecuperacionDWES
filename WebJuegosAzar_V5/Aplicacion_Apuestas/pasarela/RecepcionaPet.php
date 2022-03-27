<html> 
<body> 
<?php
	session_start();
	include 'apiRedsys.php';
	include_once '../db/db.php';
	include_once '../models/RegistroApostante_model.php';
	
	// Se crea Objeto
	$miObj = new RedsysAPI;

if (!empty( $_POST ) ) {//URL DE RESP. ONLINE
						
					$version = $_POST["Ds_SignatureVersion"];
					$datos = $_POST["Ds_MerchantParameters"];
					$signatureRecibida = $_POST["Ds_Signature"];
					

					$decodec = $miObj->decodeMerchantParameters($datos);	
					$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
					$firma = $miObj->createMerchantSignatureNotif($kc,$datos);	
					
					
					echo PHP_VERSION."<br/>";
					echo $firma."<br/>";
					echo $signatureRecibida."<br/>";
					
					if ($firma === $signatureRecibida){
						unset($_SESSION['usuario']);
						header("Location:../views/ResultadoPasarelaOK_views.php");
					} 
					else {
						unset($_SESSION['usuario']);
						header("Location:../views/ResultadoPasarelaKO_views.php");	
					}
	}
	else{
		if (!empty( $_GET ) ) {//URL DE RESP. ONLINE
				
			$version = $_GET["Ds_SignatureVersion"];
			$datos = $_GET["Ds_MerchantParameters"];
			$signatureRecibida = $_GET["Ds_Signature"];
			
			
			$decodec = $miObj->decodeMerchantParameters($datos);
			$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
			$firma = $miObj->createMerchantSignatureNotif($kc,$datos);

			if ($firma === $signatureRecibida){
				unset($_SESSION['usuario']);
				header("Location:../views/ResultadoPasarelaOK_views.php");
			} 
			else {
				unset($_SESSION['usuario']);
				header("Location:../views/ResultadoPasarelaKO_views.php");	
			}
		}
		else{
			die("No se recibió respuesta");
		}
	}
?>

</body> 
</html> 