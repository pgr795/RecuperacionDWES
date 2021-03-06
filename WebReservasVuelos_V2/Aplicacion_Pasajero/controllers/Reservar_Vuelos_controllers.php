<?php
session_start();
	if(!isset($_SESSION['email']) && !isset($_SESSION['nombre']) && !isset($_SESSION['id'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['nombre']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
		header("Location:../index.php");
	}
	
	include_once '../db/db.php';
	include_once '../models/Reservar_Vuelos_model.php';
	include_once '../views/Reservar_Vuelos_views.php';
	
	$conexion=conexion();
	
if($_SERVER["REQUEST_METHOD"] == "POST") {	
		$accion=$_POST["accion"];
		$dni=$_SESSION["id"];
		$fecha=date('Y-m-d H:i:s');
		$sorteo=$_POST['idSorteo'];
		$usuario=$_SESSION['usuario'];
	
			if($accion=="Agregar Vuelo"){
				if(!empty($_POST['n1']) || !empty($_POST['n2']) || !empty($_POST['n3']) || !empty($_POST['n4']) || !empty($_POST['n5']) || !empty($_POST['n6']) || !empty($_POST['c']) || !empty($_POST['r'])){
					
					$n1=$_POST['n1'];
					$n2=$_POST['n2'];
					$n3=$_POST['n3'];
					$n4=$_POST['n4'];
					$n5=$_POST['n5'];
					$n6=$_POST['n6'];
					$c=$_POST['c'];
					$r=$_POST['r'];
				
					if($n1 <= 49 || $n1!=0 && $n2 <= 49 || $n2!=0 && $n3 <= 49 || $n3!=0 && $n4 <= 49 || $n4!=0 && $n5 <= 49 || $n5!=0 && $n6 <= 49 || $n6!=0 && $c <= 49 || $c!=0 && $r <= 9 || $r!=0 ){
					
						if(!isset($_SESSION["$sorteo"])){
							$apuestas=array(array(
							intval($n1),
							intval($n2),
							intval($n3),
							intval($n4),
							intval($n5),
							intval($n6),
							intval($c),
							intval($r)
							));
							$_SESSION["$sorteo"]=$apuestas;
						}
						else{
							$apuestas=array(
								intval($n1),
								intval($n2),
								intval($n3),
								intval($n4),
								intval($n5),
								intval($n6),
								intval($c),
								intval($r)
							);
							array_push($_SESSION["$sorteo"],$apuestas);
						}	
					}
					else{
						echo "<br>";
						echo "<h2 style='color:gray;'>Has puesto mal algun numero</h2>";
					}
			}
			else{
				echo "<br>";
				echo "<h2 style='color:gray;'>Hay casillas que estan vacias </h2>";
			}
		}
			else if($accion=="Finalizar Reserva"){
			$sorteos=sorteos($conexion,$dni);
			$saldoApostante=saldoApostante($conexion,$dni);
					
				if($saldoApostante['saldo']!=0){
					if(!isset($_SESSION[$sorteo])){
						echo "<br>";
						echo "<h2 style='color:gray;'>No hay ninguna apuesta para realizar la operacion</h2>";
					}
					foreach($sorteos as $indice => $consulta){
						$sorteo=$consulta['NSORTEO'];
							
							if(isset($_SESSION[$sorteo])){
								$apuestas=$_SESSION[$sorteo];
								realizarApuesta($conexion,$dni,$sorteo,$fecha,$apuestas);
								echo "<br>";
								echo "<h2 style='color:gray;'>El usuario: $usuario ha realizado apuestas en el sorteo:$sorteo</h2>";
								unset($_SESSION[$sorteo]);
							}
					}
				}
				else{
					foreach($sorteos as $indice => $consulta){
						$sorteo=$consulta['NSORTEO'];
						if(isset($_SESSION[$sorteo])){
							unset($_SESSION[$sorteo]);
						}
					}
					echo "<br>";
					echo "<h2 style='color:gray;'>$usuario no puede realizar la apuesta porque su saldo esta a 0???</h2>";
					}
		}
			else if($accion=="Borrar Vuelos"){
			$sorteos=sorteos($conexion,$dni);
			if(isset($_SESSION[$sorteo])){
				foreach($sorteos as $indice => $consulta){
						$sorteo=$consulta['NSORTEO'];
						if(isset($_SESSION[$sorteo])){
							unset($_SESSION[$sorteo]);
						}
				}
				echo "<br>";
				echo "<h2 style='color:gray;'>Apuestas borradas</h2>";
			}
			else{
				echo "<br>";
				echo "<h2 style='color:gray;'>No hay ninguna apuesta para borrar</h2>";
			}
		}
	}
	var_dump($_POST);
?>
