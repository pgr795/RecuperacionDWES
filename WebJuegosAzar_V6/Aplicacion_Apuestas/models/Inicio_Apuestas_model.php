<?php
function saldo($conexion,$id){
	try {
			$consulta = $conexion->prepare("SELECT saldo FROM apostante WHERE dni='$id'");	 
			$consulta->execute();
			$resultado= $consulta->fetch(PDO::FETCH_ASSOC);
			return $resultado;
		}
		catch(PDOException $e){
			echo "Error sorteos"."<br>";
			echo $e->getMessage();
		}
		$conexion=null;
	}
function mostrarSaldo($saldo){
	echo $saldo['saldo'];
}

function sorteos($conexion,$dni){
	try {
		$select = $conexion->prepare("SELECT NSORTEO FROM sorteo WHERE activo='S'");	 
		$select->execute();
			
		$resultado= $select->fetchAll(PDO::FETCH_ASSOC);
		
		return $resultado;
		
		}
		catch(PDOException $e){
			echo "Error sorteos"."<br>";
			echo $e->getMessage();
			}
	}

?>