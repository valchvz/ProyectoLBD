<?php 
include '../../includes/header.php';
include '../../includes/database.php';

$mensaje = "";
$exito = false;

if ($_POST) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];

    $sql = "BEGIN PKG_SERVICIO.INS_SERVICIO(:nombre, :descripcion, :precio, :estado, :id_out); END;";
    $stid = oci_parse($conn, $sql);

    oci_bind_by_name($stid, ":nombre", $nombre);
    oci_bind_by_name($stid, ":descripcion", $descripcion);
    oci_bind_by_name($stid, ":precio", $precio);
    oci_bind_by_name($stid, ":estado", $estado);

    $id_out = 0;
    oci_bind_by_name($stid, ":id_out", $id_out, -1, SQLT_INT);

    if (oci_execute($stid)) {
        $mensaje = "Servicio creado correctamente. ID: " . $id_out;
        $exito = true;
    } else {
        $e = oci_error($stid);
        $mensaje = "Error: " . $e['message'];
    }
}
?>

<div class="container py-4">
    <h2>Registrar Servicio</h2>

    <?php if ($mensaje): ?>
        <div class="alert <?= $exito ? 'alert-success' : 'alert-danger' ?>">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label class="form-label">Nombre del servicio</label>
        <input type="text" name="nombre" class="form-control" required>

        <label class="form-label mt-3">Descripción</label>
        <textarea name="descripcion" class="form-control"></textarea>

        <label class="form-label mt-3">Precio</label>
        <input type="number" step="0.01" name="precio" class="form-control" required>

        <label class="form-label mt-3">Estado</label>
        <select name="estado" class="form-control">
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>
        </select>

        <button class="btn btn-primary mt-4">Guardar</button>
        <a href="listar.php" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
