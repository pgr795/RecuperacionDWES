<?php
function datosHistorial($conexion,$idUsuario,$fechadesde,$fechahasta){
	try {
		$consulta = $conexion->prepare("SELECT invoiceid,invoicedate,total,Fecha_Transaccion,Hora_Transaccion FROM invoice WHERE customerid='$idUsuario' AND invoicedate BETWEEN '$fechadesde' AND '$fechahasta'");	 
		$consulta->execute();
		$resultado= $consulta->fetchAll(PDO::FETCH_NUM);
		return $resultado;	
	}
	catch(PDOException $e){
		echo "Error datosHistorial()"."<br>";
		echo $e->getMessage();
	}
}

?>