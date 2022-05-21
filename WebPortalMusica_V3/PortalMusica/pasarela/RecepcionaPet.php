<html> 
<body> 
<?php
		session_start();
		// Se incluye la librería
		include 'apiRedsys.php';
		include_once '../db/db.php';
		include_once '../models/Descargas_model.php';
		$conexion=conexion();
			
		// Se crea Objeto
		$miObj = new RedsysAPI;
								
	if (!empty( $_POST ) ) {//URL DE RESP. ONLINE
					$version = $_GET["Ds_SignatureVersion"];
					$datos = $_GET["Ds_MerchantParameters"];
					$signatureRecibida = $_GET["Ds_Signature"];
						
					$decodec = $miObj->decodeMerchantParameters($datos);	
					$amount=$miObj->getParameter("Ds_Amount");
					$fecha=$miObj->getParameter("Ds_Date");
					$hora=$miObj->getParameter("Ds_Hour");
					$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
					$firma = $miObj->createMerchantSignatureNotif($kc,$datos);	
					$invoiceId=$_SESSION['invoiceId'];
					$precio=precioTotal($conexion,$invoiceId);
					$precio=$precio[0];	
					
					$fecha=str_replace("%2F","/",$fecha);
					$fechaBD = explode("/", $fecha);
					$fechaBD=array_reverse($fechaBD);
					$fechaBD=implode("/", $fechaBD);
					$hora=str_replace("%3A",":",$hora);

					
					echo PHP_VERSION."<br/>";
					echo $firma."<br/>";
					echo $signatureRecibida."<br/>";
					if ($firma === $signatureRecibida){
						actualizarFechaHora($conexion,$invoiceId,$fechaBD,$hora);
						include_once '../views/ResultadoPasarelaOK_views.php';
					} else {
						include_once '../views/ResultadoPasarelaKO_views.php';
					}
	}
	else{
		if (!empty( $_GET ) ) {//URL DE RESP. ONLINE
				
			$version = $_GET["Ds_SignatureVersion"];
			$datos = $_GET["Ds_MerchantParameters"];
			$signatureRecibida = $_GET["Ds_Signature"];
				
			$decodec = $miObj->decodeMerchantParameters($datos);	
			$amount=$miObj->getParameter("Ds_Amount");
			$fecha=$miObj->getParameter("Ds_Date");
			$hora=$miObj->getParameter("Ds_Hour");
			$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
			$firma = $miObj->createMerchantSignatureNotif($kc,$datos);	
			$invoiceId=$_SESSION['invoiceId'];
			$precio=precioTotal($conexion,$invoiceId);
			$precio=$precio[0];	
			
			$fecha=str_replace("%2F","/",$fecha);
			$fechaBD = explode("/", $fecha);
			$fechaBD=array_reverse($fechaBD);
			$fechaBD=implode("/", $fechaBD);
			$hora=str_replace("%3A",":",$hora);

			if ($firma === $signatureRecibida){
				actualizarFechaHora($conexion,$invoiceId,$fechaBD,$hora);
				include_once '../views/ResultadoPasarelaOK_views.php';
			} else {
				include_once '../views/ResultadoPasarelaKO_views.php';
			}
		}
		else{
			die("No se recibió respuesta");
		}
	}
?>
</body> 
</html> 