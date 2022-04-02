<?php
//Revisar
function actualizarSaldo($conexion,$dni,$saldo){
	try{
		$saldoViejo=saldoApostante($conexion,$dni);
		$saldoNuevo=intval($saldoViejo['saldo'])+intval($saldo);
		var_dump($saldo);
		var_dump($saldoViejo);
		var_dump($saldoNuevo);
		$updates= "UPDATE apostante SET SALDO='$saldoNuevo' WHERE DNI='$dni'";
		$conexion->exec($updates);		
		
	}
	catch(PDOException $e){
			echo "Error actualizarSaldo"."<br>";
			echo $e->getMessage();
	}	
}

function saldoApostante($conexion,$dni){
	try {
		$consulta=$conexion->prepare("SELECT saldo FROM apostante WHERE dni='$dni'");
		$consulta->execute();
		
		$resultado=$consulta->fetch(PDO::FETCH_ASSOC);
		
		return $resultado;
		
		}
		catch(PDOException $e){
			echo "Error saldoApostante"."<br>";
			echo $e->getMessage();
		}
	}
?>