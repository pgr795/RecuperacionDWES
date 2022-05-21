<?php
	session_start();
	if(!isset($_SESSION['id']) && !isset($_SESSION['nombre']) && !isset($_SESSION['company'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['company']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
	}
	include_once '../db/db.php';
	include_once '../models/Descargas_model.php';
	include_once '../views/Descargas_views.php';
	
	$conexion=conexion();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {	
		$accion=$_POST["accion"];
		$cancion=$_POST["cancion"];
		$idUsuario=$_SESSION['id'];
		
		if($accion=="AGREGAR A CESTA"){
			if(!empty($cancion)){
				if(!isset($_SESSION["canciones"])){
					$idCanciones=array($cancion);
					$_SESSION["idCanciones"]=$idCanciones;
					
					$cancionDato=datosCancion($conexion,$cancion);
					
					$canciones=array($cancionDato);
					$_SESSION["canciones"]=$canciones;
					
					mostrarCanciones($canciones);
				}
				else{
					array_push($_SESSION["idCanciones"],$cancion);
					
					$cancionDato=datosCancion($conexion,$cancion);
					
					array_push($_SESSION["canciones"],$cancionDato);
					$canciones=$_SESSION["canciones"];
					
					mostrarCanciones($canciones);
				}
			}
			else{
				echo "<br>";
				echo "<h2 style='color:gray;'>No has seleccionado ninguna cancion </h2>";
				echo "<br>";
			}	
		}
		else if($accion=="DESCARGAR"){
				if(isset($_SESSION["idCanciones"]) && isset($_SESSION["canciones"])){
						$canciones=$_SESSION["idCanciones"];
						$invoiceId=maxInvoiceId($conexion);
						$customerId=$_SESSION['id'];
						$fecha=date('Y-m-d');
						
						$error=insertInvoice($conexion,$invoiceId,$customerId,$fecha);
						
						if($error==0){
							if($error==0){
								foreach($canciones as $cancion){
									$invoiceLineId=maxInvoiceLineId($conexion,$invoiceId);
									$error=insertarInvoiceLine($conexion,$invoiceLineId,$invoiceId,$cancion);
								}
							}
							if($error==0){
								$preciototal=precioTotal($conexion,$invoiceId);
								$preciototal=floatval($preciototal[0]);
								$error=actualizarPrecioTotal($conexion,$invoiceId,$preciototal);
								unset($_SESSION["idCanciones"]);
								unset($_SESSION["canciones"]);
							}
							if($error==0){
								header('Location:../pasarela/GeneraPet.php');
								$_SESSION['invoiceId']=$invoiceId;
							}
						}
				}		
				else{
					echo "<br>";
					echo "<h2 style='color:gray;'>No has seleccionado ninguna cancion para descargar</h2>";
					echo "<br>";
				}	
		}
		else if($accion=="VACIAR CESTA"){
			if(isset($_SESSION["canciones"])){
				unset($_SESSION["canciones"]);
				unset($_SESSION["idCanciones"]);
				echo "<br>";
				echo "<h2 style='color:gray;'>Las canciones seleccionadas han sido eliminadas</h2>";
				echo "<br>";
			}
			else{
				echo "<br>";
				echo "<h2 style='color:gray;'>No hay canciones para eliminar</h2>";
				echo "<br>";
			}
		}
	}

?>