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
function recopilarDatos($conexion,$sorteo,$id){
		try {
			$consulta = $conexion->prepare("SELECT * FROM apuestas WHERE NSORTEO='$sorteo' AND dni='$id'");	 
			$consulta->execute();
			
			$resultado= $consulta->fetchAll(PDO::FETCH_NUM);

			return $resultado;
		}
		catch(PDOException $e){
			echo "Error recopilarDatos"."<br>";
			echo $e->getMessage();
		}
	}
?>
