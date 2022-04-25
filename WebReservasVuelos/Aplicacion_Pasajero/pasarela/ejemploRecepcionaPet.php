<html> 
<body> 
<?php
	session_start();
	include 'apiRedsys.php';
	
	// Se crea Objeto
	$miObj = new RedsysAPI;
	
	
if (!empty( $_POST ) ) {//URL DE RESP. ONLINE
					
					$version = $_POST["Ds_SignatureVersion"];
					$datos = $_POST["Ds_MerchantParameters"];
					$signatureRecibida = $_POST["Ds_Signature"];
					

					$decodec = $miObj->decodeMerchantParameters($datos);	
					// $amount=$miObj->getParameter("DS_AMOUNT");
					$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
					$firma = $miObj->createMerchantSignatureNotif($kc,$datos);	

					echo PHP_VERSION."<br/>";
					echo $firma."<br/>";
					echo $signatureRecibida."<br/>";
					if ($firma === $signatureRecibida){
						echo "FIRMA OK";
						header("Location:../views/ResultadoCargarSaldoOK_views.php");
					} else {
						echo "FIRMA KO";
						header("Location:../views/ResultadoCargarSaldoKO_views.php");
					}
	}
	else{
		if (!empty( $_GET ) ) {//URL DE RESP. ONLINE
				
			$version = $_GET["Ds_SignatureVersion"];
			$datos = $_GET["Ds_MerchantParameters"];
			$signatureRecibida = $_GET["Ds_Signature"];
				
		
			$decodec = $miObj->decodeMerchantParameters($datos);
			// $amount=$miObj->getParameter("DS_AMOUNT");
			$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
			$firma = $miObj->createMerchantSignatureNotif($kc,$datos);
		
			if ($firma === $signatureRecibida){
				echo "FIRMA OK";
				header("Location:../views/ResultadoCargarSaldoOK_views.php");	
			} else {
				echo "FIRMA KO";
				header("Location:../views/ResultadoCargarSaldoKO_views.php");	
			}
		}
		else{
			die("No se recibió respuesta");
		}
	}

?>
</body> 
</html> 