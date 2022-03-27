-- Comprobar el usuarios en el login
SELECT dni,nombre,apellido FROM empleado WHERE dni='$usuario' AND apellido='$password';
-- BUSCAR EL DNI EN LA BASE DE DATOS
SELECT dni FROM empleado Where dni='$dni';
-- Insertar un empleado
INSERT INTO empleado VALUES ('$dni','$nombre','$apellido','$email');
-- Buscar el ultimo numero del sorteo
SELECT max(NSORTEO) as codigo FROM sorteo;
-- Insertar los datos del sorteo
INSERT INTO sorteo VALUES ('$nSorteo','$fecha','0','0','$dni','S','');
-- Mostrar Sorteos Activos
SELECT NSORTEO FROM sorteo WHERE activo='S';
-- Mostrar Sorteos Activos del empleado
SELECT NSORTEO FROM sorteo WHERE activo='S' AND dni='$id'
-- Mostrar todos los datos del sorteo del empleado
SELECT * FROM sorteo WHERE NSORTEO='$sorteo'
-- Ultimo id del sorteo
SELECT NSORTEO FROM sorteo WHERE dni='$id'
-- Actualizar premios
UPDATE sorteo SET COMBINACION_GANADORA ='$combinacion' WHERE nSorteo='$nSorteo'


