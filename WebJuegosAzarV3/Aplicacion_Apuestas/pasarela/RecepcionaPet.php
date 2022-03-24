<html> 
<body> 
<?php
	session_start();
	include 'apiRedsys.php';
	include_once '../db/db.php';
	include_once '../models/RegistroApostante_model.php';
	
	
	$datos=$_SESSION['usuario'];
	$dni=$datos[0];
	$nombre=$datos[1];
	$apellido=$datos[2];
	$email=$datos[3];
	$saldo=$datos[4];
	$conexion=conexion();
	unset($_SESSION['usuario']);
	
	
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
					
							$respuesta=comprobarDNI($conexion,$dni);
							var_dump($respuesta);
							if($respuesta==0 && !empty($dni)){
							
								$respuesta="ok";
								
								
								 registroApostante($conexion,$dni,$nombre,$apellido,$email,$saldo);
								echo "<p>".$nombre." ".$apellido." te has registrado en el sistema</p><br>";
								echo "<form method='POST' action='../controllers/RegistroApostante_controllers.php'>";
								//echo "<input type='text' hidden name='respuesta' value='$respuesta'/>"
								echo"<input type='submit' name='accion' value='Volver'/>";
								echo "</form>";
								
							}
							else{
								echo "<p>Ya existe este usuario</p><br>";
								echo "<form method='POST' action='../controllers/RegistroApostante_controllers.php'>";
								//echo "<input type='text' hidden name='respuesta' value='$respuesta'/>"
								echo"<input type='submit' name='accion' value='Volver'/>";
								echo "</form>";
							}

					} else {
							$respuesta="error";
							echo "<p>No se ha podido registrar en el sistema</p><br>";
							echo "<form method='POST' action='../controllers/RegistroApostante_controllers.php'>
									<input type='text' hidden name='respuesta' value='$respuesta'/>
									<input type='submit' name='accion' value='Volver'/>
								  </form>";
				///			var_dump($Importe);
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
				$respuesta=comprobarDNI($conexion,$dni);
							var_dump($respuesta);
							if($respuesta==0){	
								$respuesta="ok";
								 registroApostante($conexion,$dni,$nombre,$apellido,$email,$saldo);
								echo "<p>".$nombre." ".$apellido." te has registrado en el sistema</p><br>";
								echo "<form method='POST' action='../controllers/RegistroApostante_controllers.php'>";
								//echo "<input type='text' hidden name='respuesta' value='$respuesta'/>"
								echo"<input type='submit' name='accion' value='Volver'/>";
								echo "</form>";
								
							}
							else{
								echo "<p>Ya existe este usuario</p><br>";
								echo "<form method='POST' action='../controllers/RegistroApostante_controllers.php'>";
								//echo "<input type='text' hidden name='respuesta' value='$respuesta'/>"
								echo"<input type='submit' name='accion' value='Volver'/>";
								echo "</form>";
							}
			} 
			else {
				$respuesta="error";
				echo "<p>No se ha podido registrar en el sistema</p>";
				echo "<form method='GET' action='../controllers/RegistroApostante_controllers.php'>
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