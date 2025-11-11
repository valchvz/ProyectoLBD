<?php
$conn = oci_connect("Proyecto", "proyecto123", "localhost/XEPDB1");

if (!$conn) {
    $e = oci_error();
    echo "<b>Error de conexión:</b><br>" . htmlentities($e['message']);
} else {
    echo "<b>Conexión exitosa con Oracle</b>";
}
?>
