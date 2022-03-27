<?php
session_start();

if(!isset($_SESSION['id']) && !isset($_SESSION['usuario'])){
	unset($_SESSION['id']);
	unset($_SESSION['usuario']);
	session_destroy();
	header("Location:../index.php");
}

include_once '../db/db.php';
include_once '../models/RealizarSorteo_model.php';
include_once '../views/RealizarSorteo_views.php';


$conexion=conexion();
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		//var_dump($_POST);
		$accion=$_POST["accion"];
		$idUsuario=$_SESSION["id"];
		
		if(isset($_POST["idSorteo"])){
			$SorteoActivo=$_POST["idSorteo"];
			if($accion=="Realizar Sorteo"){
				if(isset($_SESSION["$SorteoActivo"])){
					$combinacionGanadora=$_SESSION["$SorteoActivo"];
					realizarSorteo($conexion,$SorteoActivo,$combinacionGanadora,$idUsuario);	
				}
				else{	
					$SorteoActivo="";
					echo "No hay sorteo activo en este momento o no has dado al boton de generar combinacionGanadora ";
				}
			}
			else if($accion=="Generar combinacion ganadora"){
				$combinacionSorteo=combinacionGanadora();
				
				if(!isset($_SESSION["$SorteoActivo"])){
						//var_dump($combinacionSorteo);
						mostrarCombinacionGanadora($combinacionSorteo);
						$_SESSION["$SorteoActivo"]=$combinacionSorteo;
						
				}
				else if(isset($_SESSION["$SorteoActivo"])){
						$combinacion=$_SESSION["$SorteoActivo"];
						mostrarCombinacionGanadora($_SESSION["$SorteoActivo"]);
						echo "Ya has generado la combinacion Ganadora";
				}
			}
			else{
				if($accion=="Atras"){
					$sorteos=sorteos($conexion,$dni);
					foreach($sorteos as $indice => $consulta){
						$sorteo=$consulta['NSORTEO'];
						if(isset($_SESSION["$sorteo"])){
							unset($_SESSION["$sorteo"]);
						}
					}
					header("Location:Inicio_Hacienda_controllers.php");
				}
				else{
					echo "No hay sorteos activos";
				}
			}
		}
		else{
				if($accion=="Atras"){
					$sorteos=sorteos($conexion,$dni);
					foreach($sorteos as $indice => $consulta){
						$sorteo=$consulta['NSORTEO'];
						if(isset($_SESSION["$sorteo"])){
							unset($_SESSION["$sorteo"]);
						}
					}
					header("Location:Inicio_Hacienda_controllers.php");
				}
				else{
					echo "No hay sorteos activos";
				}
			}
	}
	var_dump($_SESSION);
?>