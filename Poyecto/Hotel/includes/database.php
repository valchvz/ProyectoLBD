<?php
$conn = oci_pconnect("PROYECTO", "proyecto123", "localhost/XEPDB1");

if (!$conn) {
    $e = oci_error();
    die("<b>Error de conexión:</b><br>" . htmlentities($e['message']));
}
?>
