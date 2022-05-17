<?php
function login($conexion,$usuario,$password){
	try{
		$consultar = $conexion->prepare("SELECT emailaddress,birthdate,name,passenger_id FROM passengerdetails WHERE emailaddress='$usuario' AND birthdate='$password'");
		$consultar->execute();
		$cont=0;
		
		foreach($consultar->fetchAll() as $consulta){
                $emailaddressBD=$consulta["emailaddress"];
				$birthdateBD=$consulta["birthdate"];
				$cont++;
		}
		
		if($cont == 1){
			if($emailaddressBD==$usuario && $birthdateBD==$password){
                    $consultar->execute();
                    return $consultar->fetchAll();
			}
		}
	}
	catch(PDOException $e){
		echo "Error: Login() " . $e->getMessage();	
	}
}
?>