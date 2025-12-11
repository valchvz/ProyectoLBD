<?php
include '../../includes/database.php';

echo "Iniciando inserción...<br>";

$sql = "BEGIN PKG_CLIENTE.INS_CLIENTE(
    :n, :ap1, :ap2, :c, :t, :tipo, :estado, :outid
); END;";

$stid = oci_parse($conn, $sql);

$nombre = "Prueba_" . rand(1000,9999);
$ap1 = "Test";
$ap2 = "Demo";
$correo = "test" . rand(1000,9999) . "@mail.com";
$telefono = "88888888";
$tipo = 1;
$estado = 1;

oci_bind_by_name($stid, ":n", $nombre);
oci_bind_by_name($stid, ":ap1", $ap1);
oci_bind_by_name($stid, ":ap2", $ap2);
oci_bind_by_name($stid, ":c", $correo);
oci_bind_by_name($stid, ":t", $telefono);
oci_bind_by_name($stid, ":tipo", $tipo);
oci_bind_by_name($stid, ":estado", $estado);

oci_bind_by_name($stid, ":outid", $outid, 32);

$start = microtime(true);
oci_execute($stid);
$end = microtime(true);

$tiempo = $end - $start;

echo "<br><br><b>Cliente insertado con ID:</b> $outid<br>";
echo "<b>Tiempo de ejecución:</b> " . round($tiempo, 3) . " segundos";
