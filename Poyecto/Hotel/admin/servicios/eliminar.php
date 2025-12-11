<?php
include '../../includes/database.php';

$id = $_GET['id'];

$sql = "BEGIN PKG_SERVICIO.DEL_SERVICIO(:id); END;";
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":id", $id);

if (oci_execute($stid)) {
    header("Location: listar.php?msg=deleted");
    exit;
} else {
    $e = oci_error($stid);
    echo "Error: " . $e['message'];
}
