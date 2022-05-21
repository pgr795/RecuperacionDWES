<?php
function login($conexion,$usuario,$password){
	try{
		$consultar = $conexion->prepare("SELECT Email,CustomerId,FirstName,LastName,Company FROM customer WHERE Email='$usuario' AND LastName='$password'");
		$consultar->execute();
		$cont=0;
		
		foreach($consultar->fetchAll() as $consulta){
                $EmailBD=$consulta["Email"];
				$LastNameBD=$consulta["LastName"];
				$cont++;
		}
		
		if($cont == 1){
			if($EmailBD==$usuario && $LastNameBD==$password){
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