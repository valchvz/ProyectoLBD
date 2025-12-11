<?php 
include '../../includes/header.php';
include '../../includes/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<div class='alert alert-danger'>ID inválido</div>";
    exit;
}

// ---------------------------------------------------
// 1. OBTENER DATOS DEL EMPLEADO
// ---------------------------------------------------
$sql = "BEGIN PKG_EMPLEADO.OBTENER_EMPLEADO(:id, :cursor); END;";
$stid = oci_parse($conn, $sql);

oci_bind_by_name($stid, ":id", $id);

$cursor = oci_new_cursor($conn);
oci_bind_by_name($stid, ":cursor", $cursor, -1, OCI_B_CURSOR);

oci_execute($stid);
oci_execute($cursor);

$empleado = oci_fetch_assoc($cursor);

if (!$empleado) {
    echo "<div class='alert alert-danger'>Empleado no encontrado</div>";
    exit;
}

$mensaje = "";

// ---------------------------------------------------
// 2. SI SE ENVÍA FORMULARIO, ACTUALIZAR
// ---------------------------------------------------
if ($_POST) {

    $sql2 = "BEGIN PKG_EMPLEADO.UPD_EMPLEADO(
        :id,
        :n, :ap1, :ap2,
        :cor, :pass, :tel,
        :puesto, :estado
    ); END;";

    $stid2 = oci_parse($conn, $sql2);

    oci_bind_by_name($stid2, ":id", $id);
    oci_bind_by_name($stid2, ":n", $_POST['nombre']);
    oci_bind_by_name($stid2, ":ap1", $_POST['primer_apellido']);
    oci_bind_by_name($stid2, ":ap2", $_POST['segundo_apellido']);
    oci_bind_by_name($stid2, ":cor", $_POST['correo']);
    oci_bind_by_name($stid2, ":pass", $_POST['contrasena']);
    oci_bind_by_name($stid2, ":tel", $_POST['telefono']);
    oci_bind_by_name($stid2, ":puesto", $_POST['id_puesto']);
    oci_bind_by_name($stid2, ":estado", $_POST['id_estado']);

    if (oci_execute($stid2)) {
        $mensaje = "Empleado actualizado correctamente.";
    } else {
        $e = oci_error($stid2);
        $mensaje = "Error: " . $e['message'];
    }
}
?>

<div class="container mt-4">

    <h2 class="fw-bold">Editar Empleado</h2>

    <?php if ($mensaje != ""): ?>
        <div class="alert alert-info"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Nombre:</label>
        <input name="nombre" value="<?= $empleado['NOMBRE'] ?>" class="form-control mb-2" required>

        <label>Primer apellido:</label>
        <input name="primer_apellido" value="<?= $empleado['PRIMER_APELLIDO'] ?>" class="form-control mb-2" required>

        <label>Segundo apellido:</label>
        <input name="segundo_apellido" value="<?= $empleado['SEGUNDO_APELLIDO'] ?>" class="form-control mb-2" required>

        <label>Correo:</label>
        <input name="correo" type="email" value="<?= $empleado['CORREO_ELECTRONICO'] ?>" class="form-control mb-2" required>

        <label>Contraseña:</label>
        <input name="contrasena" value="<?= $empleado['CONTRASENA'] ?>" class="form-control mb-2" required>

        <label>Teléfono:</label>
        <input name="telefono" value="<?= $empleado['NUM_TELEFONO'] ?>" class="form-control mb-2" required>

        <label>Puesto:</label>
        <select name="id_puesto" class="form-control mb-2">
            <option value="1" <?= $empleado['ID_PUESTO_TRABAJO']==1?"selected":"" ?>>Gerente</option>
            <option value="2" <?= $empleado['ID_PUESTO_TRABAJO']==2?"selected":"" ?>>Recepción</option>
            <option value="3" <?= $empleado['ID_PUESTO_TRABAJO']==3?"selected":"" ?>>Limpieza</option>
        </select>

        <label>Estado:</label>
        <select name="id_estado" class="form-control mb-3">
            <option value="1" <?= $empleado['ID_ESTADO']==1?"selected":"" ?>>Activo</option>
            <option value="2" <?= $empleado['ID_ESTADO']==2?"selected":"" ?>>Inactivo</option>
        </select>

        <button class="btn btn-success w-100">Actualizar</button>
    </form>

</div>

<?php include '../../includes/footer.php'; ?>
