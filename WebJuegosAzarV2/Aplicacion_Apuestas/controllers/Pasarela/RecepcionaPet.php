<html> 
<body> 
<?php
	include 'apiRedsys.php';

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
					
					$respuesta;
					
					if ($firma === $signatureRecibida){
							$respuesta="ok";
							echo "<p>Ya estas registrado en el sistema</p><br>";
							echo "<form method='POST' action='registro.php'>
									<input type='text' hidden name='respuesta' value='$respuesta'/>
									<input type='submit' name='accion' value='Volver'/>
								  </form>";
					} else {
							$respuesta="error";
							echo "<p>No se ha podido registrar en el sistema</p><br>";
							echo "<form method='POST' action='registro.php'>
									<input type='text' hidden name='respuesta' value='$respuesta'/>
									<input type='submit' name='accion' value='Volver'/>
								  </form>";
					}
					var_dump($_POST);
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
				$respuesta="ok";
				echo "<p>Ya estas registrado en el sistema</p>";
				echo "<form method='GET' action='registro.php'>
						<input type='text' hidden name='respuesta' value='$respuesta'/>
						<input type='submit' name='accion' value='Volver'/>
					 </form>";
				var_dump($respuesta);
			} else {
				$respuesta="error";
				echo "<p>No se ha podido registrar en el sistema</p>";
				echo "<form method='GET' action='registro.php'>
						<input type='text' name='respuesta' value='$respuesta'/>
						<input type='submit' name='accion' value='Volver'/>
					 </form>";
				var_dump($respuesta);
			}
		}
		else{
			die("No se recibió respuesta");
		}
	}
?>

</body> 
</html> 