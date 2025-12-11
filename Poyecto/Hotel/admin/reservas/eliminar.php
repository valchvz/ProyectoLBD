<?php
include '../../includes/header.php';
include '../../includes/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM TB_RESERVA WHERE ID_RESERVA = :id";

$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":id", $id);
oci_execute($stid);

echo "<script>
        alert('Reserva eliminada correctamente');
        window.location='listar.php';
      </script>";
?>
