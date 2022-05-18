<?php
function datosFacturas($conexion,$idUsuario,$factura){
	try {
		$consulta = $conexion->prepare("SELECT InvoiceLineId,name,composer FROM invoice i,invoiceline v, track t WHERE i.InvoiceId=v.InvoiceId AND v.TrackId=t.TrackId AND customerid='$idUsuario' AND i.InvoiceId='$factura'");	 
		$consulta->execute();
		$resultado= $consulta->fetchAll(PDO::FETCH_NUM);
		return $resultado;
	}
	catch(PDOException $e){
		echo "Error datosFacturas()"."<br>";
		echo $e->getMessage();
	}
}

function selectIdFacturas($idUsuario){
	try {
		$conexion=conexion();
		$consulta=$conexion->prepare("SELECT InvoiceId FROM invoice WHERE CustomerId='$idUsuario'");
		$consulta->execute();
		echo "<select name='factura' required>";
			foreach($consulta->fetchAll() as $consulta){
				echo '<option value="'.$consulta["InvoiceId"].'">'."FACTURA:".$consulta["InvoiceId"].'</option>';
			}
		echo "</select>";
	}
	catch(PDOException $e){
			echo "Error selectIdFacturas()"."<br>";
			echo $e->getMessage();
	}
}

?>
	