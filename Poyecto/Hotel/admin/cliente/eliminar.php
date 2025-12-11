<?php 
include '../../includes/header.php';
include '../../includes/database.php';

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger text-center'>ID no recibido.</div>";
    exit;
}

$id = $_GET['id'];

$sql = "BEGIN PKG_CLIENTE.DEL_CLIENTE(:id); END;";
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":id", $id);

if (oci_execute($stid)) {
    echo "
    <div class='alert alert-success text-center mt-4'>
        <strong>Cliente eliminado permanentemente.</strong>
    </div>
    <div class='text-center mt-3'>
        <a href='listar.php' class='btn btn-secondary'>Volver</a>
    </div>
    ";
} else {
    echo "
    <div class='alert alert-danger text-center mt-4'>
        <strong>No se pudo eliminar el cliente.</strong><br>
        Es posible que tenga reservas o facturas asociadas.
    </div>
    <div class='text-center mt-3'>
        <a href='listar.php' class='btn btn-secondary'>Volver</a>
    </div>
    ";
}

include '../../includes/footer.php';
?>

