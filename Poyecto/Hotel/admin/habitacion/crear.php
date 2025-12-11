<?php 
include '../../includes/header.php';
include '../../includes/database.php';

$mensaje = "";

if ($_POST) {
    $num   = $_POST['num'];
    $tipo  = $_POST['tipo'];
    $estado = $_POST['estado'];

    $sql = "BEGIN PKG_HABITACION.INS_HABITACION(:num, :tipo, :estado, :id_out); END;";
    $stid = oci_parse($conn, $sql);

    oci_bind_by_name($stid, ":num", $num);
    oci_bind_by_name($stid, ":tipo", $tipo);
    oci_bind_by_name($stid, ":estado", $estado);
    oci_bind_by_name($stid, ":id_out", $id_out, 32);

    if (oci_execute($stid)) {
        $mensaje = "<div class='alert alert-success'>Habitación creada correctamente. ID: $id_out</div>";
    } else {
        $e = oci_error($stid);
        $mensaje = "<div class='alert alert-danger'>Error: {$e['message']}</div>";
    }
}
?>

<div class="container mt-4">
    <h2 class="fw-bold mb-3">Registrar Habitación</h2>

    <?= $mensaje ?>

    <form method="POST" class="card p-4 shadow" style="max-width: 500px;">

        <label>Número de Habitación:</label>
        <input type="text" name="num" class="form-control mb-3" required>

        <label>Tipo de Habitación (ID):</label>
        <input type="number" name="tipo" class="form-control mb-3" required>

        <label>Estado:</label>
        <select name="estado" class="form-control mb-3">
            <option value="1">Activa</option>
            <option value="0">Inactiva</option>
        </select>

        <button class="btn btn-success">Guardar</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>

    </form>
</div>

<?php include '../../includes/footer.php'; ?>
