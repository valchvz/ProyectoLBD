<?php 
include '../../includes/header.php';
include '../../includes/database.php';

$id = $_GET['id'] ?? 0;
$mensaje = "";

// Obtener datos de la habitación
$sql = "SELECT * FROM TB_HABITACION WHERE ID_HABITACION = :id";
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":id", $id);
oci_execute($stid);

$data = oci_fetch_assoc($stid);

if (!$data) {
    die("<div class='alert alert-danger text-center mt-4'>Habitación no encontrada.</div>");
}

if ($_POST) {
    $num    = $_POST['num'];
    $tipo   = $_POST['tipo'];
    $estado = $_POST['estado'];

    $sql2 = "BEGIN PKG_HABITACION.UPD_HABITACION(:id, :num, :tipo, :estado); END;";
    $upd = oci_parse($conn, $sql2);

    oci_bind_by_name($upd, ":id", $id);
    oci_bind_by_name($upd, ":num", $num);
    oci_bind_by_name($upd, ":tipo", $tipo);
    oci_bind_by_name($upd, ":estado", $estado);

    if (oci_execute($upd)) {
        $mensaje = "<div class='alert alert-success'>Habitación actualizada correctamente.</div>";
    } else {
        $e = oci_error($upd);
        $mensaje = "<div class='alert alert-danger'>Error: {$e['message']}</div>";
    }
}
?>

<div class="container mt-4">
    <h2 class="fw-bold mb-3">Editar Habitación</h2>

    <?= $mensaje ?>

    <form method="POST" class="card p-4 shadow" style="max-width: 500px;">

        <label>ID Habitación (no editable):</label>
        <input class="form-control mb-3" disabled value="<?= $data['ID_HABITACION'] ?>">

        <label>Número:</label>
        <input type="text" name="num" class="form-control mb-3" value="<?= $data['NUM_HABITACION'] ?>" required>

        <label>Tipo (ID):</label>
        <input type="number" name="tipo" class="form-control mb-3" value="<?= $data['ID_TIPO_HABITACION'] ?>" required>

        <label>Estado:</label>
        <select name="estado" class="form-control mb-3">
            <option value="1" <?= $data['ID_ESTADO']==1 ? 'selected' : '' ?>>Activa</option>
            <option value="0" <?= $data['ID_ESTADO']==0 ? 'selected' : '' ?>>Inactiva</option>
        </select>

        <button class="btn btn-warning">Actualizar</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>

    </form>
</div>

<?php include '../../includes/footer.php'; ?>
