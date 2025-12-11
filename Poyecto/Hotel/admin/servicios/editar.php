<?php
include '../../includes/header.php';
include '../../includes/database.php';

$id = $_GET['id'];

// OBTENER DATOS
$sql = "SELECT * FROM TB_SERVICIO WHERE ID_SERVICIO = :id";
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":id", $id);
oci_execute($stid);

$data = oci_fetch_assoc($stid);
?>

<div class="container py-4">
    <h2>Editar Servicio</h2>

<?php
$mensaje = "";
$exito = false;

if ($_POST) {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];

    $sql2 = "BEGIN PKG_SERVICIO.UPD_SERVICIO(:id, :nombre, :descripcion, :precio, :estado); END;";
    $upd = oci_parse($conn, $sql2);

    oci_bind_by_name($upd, ":id", $id);
    oci_bind_by_name($upd, ":nombre", $nombre);
    oci_bind_by_name($upd, ":descripcion", $descripcion);
    oci_bind_by_name($upd, ":precio", $precio);
    oci_bind_by_name($upd, ":estado", $estado);

    if (oci_execute($upd)) {
        $mensaje = "Servicio actualizado correctamente.";
        $exito = true;
    } else {
        $e = oci_error($upd);
        $mensaje = "Error: " . $e['message'];
    }
}
?>

<?php if ($mensaje): ?>
    <div class="alert <?= $exito ? 'alert-success' : 'alert-danger' ?>">
        <?= $mensaje ?>
    </div>
<?php endif; ?>

<form method="POST">
    <label class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" value="<?= $data['NOMBRE'] ?>" required>

    <label class="form-label mt-3">Descripción</label>
    <textarea name="descripcion" class="form-control"><?= $data['DESCRIPCION'] ?></textarea>

    <label class="form-label mt-3">Precio</label>
    <input type="number" step="0.01" name="precio" class="form-control" value="<?= $data['PRECIO'] ?>" required>

    <label class="form-label mt-3">Estado</label>
    <select name="estado" class="form-control">
        <option value="1" <?= $data['ID_ESTADO']==1 ? 'selected':'' ?>>Activo</option>
        <option value="2" <?= $data['ID_ESTADO']==2 ? 'selected':'' ?>>Inactivo</option>
    </select>

    <button class="btn btn-primary mt-4">Guardar cambios</button>
    <a href="listar.php" class="btn btn-secondary mt-4">Cancelar</a>
</form>
</div>

<?php include '../../includes/footer.php'; ?>
