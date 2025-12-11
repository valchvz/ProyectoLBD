<?php 
include '../../includes/header.php';
include '../../includes/database.php';

$id = $_GET['id'];

$sql = "BEGIN PKG_EMPLEADO.DEL_EMPLEADO_LOGICO(:id); END;";
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":id", $id);
oci_execute($stid);

echo "<div class='alert alert-warning text-center mt-4'>
        Empleado marcado como INACTIVO.
      </div>
      <div class='text-center mt-3'>
        <a href='listar.php' class='btn btn-secondary'>Volver</a>
      </div>";
?>
