<?php
////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES 
////////////////////////////////////////////////////////////////////////////////////////////////
function insertInvoice($conexion,$invoiceId,$customerId,$fecha){
	try{
		$conexion->beginTransaction();
		$insert="INSERT INTO invoice VALUES ('$invoiceId','$customerId','$fecha','0')";
		$conexion->exec($insert);
		$conexion->commit();
	}
	catch(PDOException $e){
		echo "Error insertInvoice()"."<br>";
		echo $e->getMessage();
		$conexion->rollback();	
		$error=1;
		return $error;
		
	}
}
//'$invoiceLineId' '$invoiceId'
function insertarInvoiceLine($conexion,$invoiceLineId,$invoiceId,$cancion){
	try{
		$conexion->beginTransaction();
		$insert="INSERT INTO invoiceline VALUES ('$invoiceLineId','$invoiceId','$cancion','0.99','1')";
		$conexion->exec($insert);
		$conexion->commit();
	}
	catch(PDOException $e){
		echo "Error insertarInvoiceLine()"."<br>";
		echo $e->getMessage();
		$conexion->rollback();	
		$error=1;
		return $error;
	}
}

function actualizarPrecioTotal($conexion,$invoiceId,$preciototal){
	try{
		$conexion->beginTransaction();
		$updates= "UPDATE invoice SET Total='$preciototal' WHERE InvoiceId='$invoiceId'";
		$conexion->exec($updates);
		$conexion->commit();
	}		
	catch(PDOException $e){
		echo "Error actualizar()"."<br>";
		echo $e->getMessage();
		$conexion->rollback();	
		$error=1;
		return $error;
	}	
}

function selectCancion($id){
	try {
		$conexion=conexion();
		$select = $conexion->prepare("SELECT TrackId,Name,Composer FROM track");	 
		$select->execute();

		echo "<select name='cancion' required>";
		
		foreach($select->fetchAll() as $consulta){
			echo '<option value="'.$consulta["TrackId"].'">'.$consulta["Composer"]." || ".$consulta["Name"]." || ".'</option>';
		}
		echo "</select>";
	}
	catch(PDOException $e){
		echo "Error selectCancion()"."<br>";
		echo $e->getMessage();
	}
	$conexion=null;
}

function datosCancion($conexion,$cancion){
	try{
		$consulta=$conexion->prepare("SELECT Name,Composer FROM track Where TrackId='$cancion'");
		$consulta->execute();
		foreach($consulta->fetchAll() as $consulta){
			$resultado=$consulta["Composer"]." || ".$consulta["Name"]." || ";
		}
		return $resultado;
	}
	catch (PDOException $e) {
		echo "Error datosCancion()"."<br>";
		echo $e->getMessage();
	}	
}

function precioTotal($conexion,$invoiceId){
	try{
		$consulta=$conexion->prepare("SELECT SUM(unitPrice) FROM invoiceLine WHERE invoiceid='$invoiceId'");
		$consulta->execute();
		$resultado= $consulta->fetch(PDO::FETCH_NUM);
		return $resultado;
	}
	catch (PDOException $e) {
		echo "Error datosCancion()"."<br>";
		echo $e->getMessage();
	}	
}

function maxInvoiceId($conexion){
	try{
		$consulta=$conexion->prepare("SELECT max(InvoiceId) AS codigo FROM invoice");
		$consulta->execute();	
		foreach($consulta->fetchAll() as $consulta){
			$idBD=$consulta['codigo'];
		}	
		if($idBD==null){
			$id=1;
			return $id;
		}
		else{
			$id=$idBD;
			$id+=1;
			return $id;
		}	
	}
	catch (PDOException $e) {
		echo "Error maxInvoiceId()"."<br>";
		echo $e->getMessage();
	}
}

function maxInvoiceLineId($conexion,$invoiceId){
	try{
		$consulta=$conexion->prepare(" SELECT max(InvoiceLineId) AS codigo FROM invoiceline where invoiceId='$invoiceId'");
		$consulta->execute();	
		foreach($consulta->fetchAll() as $consulta){
			$idBD=$consulta['codigo'];
		}	
		if($idBD==null){
			$id=1;
			return $id;
		}
		else{
			$id=$idBD;
			$id+=1;
			return $id;
		}	
	}
	catch (PDOException $e) {
		echo "Error maxInvoiceLineId()"."<br>";
		echo $e->getMessage();
	}
}

?>