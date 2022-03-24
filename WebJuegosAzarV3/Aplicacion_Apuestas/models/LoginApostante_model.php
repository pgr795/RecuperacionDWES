<?php

function login($conexion,$usuario,$password){
	try{
		$consultar = $conexion->prepare("SELECT dni,nombre,apellido FROM apostante WHERE dni='$usuario' AND apellido='$password'");
		$consultar->execute();
		$cont=0;
		
		foreach($consultar->fetchAll() as $consulta){
                $dniBD=$consulta["dni"];
				$apellidoBD=$consulta["apellido"];
				$cont++;
		}
		
		if($cont == 1){
			if($dniBD==$usuario && $password==$apellidoBD){
                    $consultar->execute();
                    return $consultar->fetchAll();
			}
		}
	}
	catch(PDOException $e){
		echo "Error: Login " . $e->getMessage();	
	}
}
?>