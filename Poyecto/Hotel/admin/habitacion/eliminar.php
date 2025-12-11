<?php 
include '../../includes/header.php';
include '../../includes/database.php';

$id = $_GET['id'] ?? 0;

$sql = "BEGIN PKG_HABITACION.DEL_HABITACION(:id); END;";
$stid = oci_parse($conn, $sql);

oci_bind_by_name($stid, ":id", $id);

if (oci_execute($stid)) {
    echo "<div class='alert alert-success text-center mt-4'>Habitación eliminada correctamente.</div>";
} else {
    $e = oci_error($stid);
    echo "<div class='alert alert-danger text-center mt-4'>Error al eliminar: {$e['message']}</div>";
}
?>

<div class="text-center mt-3">
    <a href="listar.php" class="btn btn-secondary">Volver</a>
</div>

<?php include '../../includes/footer.php'; ?>

