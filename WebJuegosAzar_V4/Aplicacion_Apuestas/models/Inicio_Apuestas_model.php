<?php
function sorteos($id){
	try {
			$conexion=conexion();
			$consulta = $conexion->prepare("SELECT NSORTEO FROM sorteo");	 
			$consulta->execute();
			
			$resultado = $consulta->fetchAll(PDO::FETCH_COLUMN, 0);
			return $resultado;
		}
		catch(PDOException $e){
			echo "Error sorteos"."<br>";
			echo $e->getMessage();
		}
		$conexion=null;
	}
function mostrarSorteos($sorteos){
	echo "<select name='idSorteo'>";
		foreach($sorteos as $consulta){
			echo '<option value="'.$consulta.'">'.$consulta.'</option>';
		}
	echo "</select>";
}
function recopilarDatos($conexion,$sorteo){
		try {
			$consulta = $conexion->prepare("SELECT * FROM sorteo WHERE NSORTEO='$sorteo'");	 
			$consulta->execute();
			
			$resultado= $consulta->fetch(PDO::FETCH_ASSOC);

			return $resultado;
		}
		catch(PDOException $e){
			echo "Error recopilarDatos"."<br>";
			echo $e->getMessage();
		}
	}
function sorteos2($conexion,$idUsuario){
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