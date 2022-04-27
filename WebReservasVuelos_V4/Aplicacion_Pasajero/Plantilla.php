<?php
////////////////////////////////////////////////////////////////////////////////////////////////
//RECORRER UN ARRAY
////////////////////////////////////////////////////////////////////////////////////////////////
foreach ($array as $indice => $valor) {
    echo "Indice: ".$clave;
	foreach ($valor as $indice2 => $valor2){
		echo " Valor: ".$valor2;
		echo "<br>";
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////
//CONSULTAR
////////////////////////////////////////////////////////////////////////////////////////////////
function consulta($conexion){
	try {
		$consulta=$conexion->prepare("SELECT * FROM tabla WHERE abc='$abc'");
		$consulta->execute();
		$resultado= $consulta->fetch(PDO::FETCH_ASSOC);//array
		//$resultado= $consulta->fetch(PDO::FETCH_NUM);
		//$resultado= $consulta->fetch(PDO::FETCH_BOTH);
		//$resultado= $consulta->fetchAll();
		//$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0);  //Obtener una columna de un base de datos
		return $resultado;	
	}
	catch(PDOException $e){
			echo "Error consulta"."<br>";
			echo $e->getMessage();
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////
//INSERTAR
////////////////////////////////////////////////////////////////////////////////////////////////
function insertar($conexion){
	try{
		$insert="INSERT INTO apuestas VALUES ('$abc','$abc','$abc','$abc');";
		$conexion->exec($insert);
	}
	catch(PDOException $e){
			echo "Error insertar"."<br>";
			echo $e->getMessage();
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////
//ACTUALIZAR
////////////////////////////////////////////////////////////////////////////////////////////////
function actualizar($conexion){
	try{
		$updates= "UPDATE tabla SET abc='$abc' WHERE abc='$abc'";
		$conexion->exec($updates);
	}		
	catch(PDOException $e){
			echo "Error actualizar()"."<br>";
			echo $e->getMessage();
	}	
}
////////////////////////////////////////////////////////////////////////////////////////////////
//BORRAR
////////////////////////////////////////////////////////////////////////////////////////////////
function borrar($conexion){
	try{
		$detele= "DELETE FROM tabla WHERE abc='$abc'";
		$conexion->exec($updates);
	}		
	catch(PDOException $e){
			echo "Error borrar"."<br>";
			echo $e->getMessage();
	}	
}
////////////////////////////////////////////////////////////////////////////////////////////////
//SELECT
////////////////////////////////////////////////////////////////////////////////////////////////
function select(){
	try {
		$conexion=conexion();
		$select = $conexion->prepare("SELECT * FROM "" WHERE "''" ");	 
		$select->execute();	
		//echo "<select name='idSorteo'>";
		foreach($select->fetchAll() as $consulta){
			//echo '<option value="'.$consulta["NSORTEO"].'"selected>'.$consulta["NSORTEO"].'</option>';
		}		
		//echo "</select>";
		}
		catch(PDOException $e){
			echo "Error select"."<br>";
			echo $e->getMessage();
		}
		$conexion=null;
}
////////////////////////////////////////////////////////////////////////////////////////////////
//ULTIMO ID
////////////////////////////////////////////////////////////////////////////////////////////////
function maxID($conexion){
	try{
		$consulta=$conexion->prepare("SELECT max(id) as codigo FROM tabla");
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
		echo "Error maxID"."<br>";
		echo $e->getMessage();
	}
}


?>