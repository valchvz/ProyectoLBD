<?php 
include '../../includes/header.php';
include '../../includes/database.php';

$mensaje = "";

if ($_POST) {

    $sql = "BEGIN PKG_EMPLEADO.INS_EMPLEADO(
        :n, :ap1, :ap2,
        :cor, :pass, :tel,
        :puesto, :estado,
        :id_out
    ); END;";

    $stid = oci_parse($conn, $sql);

    oci_bind_by_name($stid, ":n", $_POST['nombre']);
    oci_bind_by_name($stid, ":ap1", $_POST['primer_apellido']);
    oci_bind_by_name($stid, ":ap2", $_POST['segundo_apellido']);
    oci_bind_by_name($stid, ":cor", $_POST['correo']);
    oci_bind_by_name($stid, ":pass", $_POST['contrasena']);
    oci_bind_by_name($stid, ":tel", $_POST['telefono']);
    oci_bind_by_name($stid, ":puesto", $_POST['id_puesto']);
    oci_bind_by_name($stid, ":estado", $_POST['id_estado']);

    oci_bind_by_name($stid, ":id_out", $id_empleado, 32);

    if (oci_execute($stid)) {
        $mensaje = "Empleado creado con éxito. ID: ".$id_empleado;
    } else {
        $e = oci_error($stid);
        $mensaje = "Error: ".$e['message'];
    }
}
?>

<div class="container mt-4">
    <h2 class="fw-bold">Registrar Empleado</h2>

    <?php if ($mensaje != ""): ?>
        <div class="alert alert-info"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Nombre:</label>
        <input name="nombre" class="form-control mb-2" required>

        <label>Primer apellido:</label>
        <input name="primer_apellido" class="form-control mb-2" required>

        <label>Segundo apellido:</label>
        <input name="segundo_apellido" class="form-control mb-2" required>

        <label>Correo:</label>
        <input name="correo" type="email" class="form-control mb-2" required>

        <label>Contraseña:</label>
        <input name="contrasena" type="password" class="form-control mb-2" required>

        <label>Teléfono:</label>
        <input name="telefono" class="form-control mb-2" required>

        <label>Puesto de trabajo:</label>
        <select name="id_puesto" class="form-control mb-2" required>
            <option value="1">Gerente</option>
            <option value="2">Recepcionista</option>
            <option value="3">Limpieza</option>
            <!-- Luego lo hacemos dinámico desde la BD -->
        </select>

        <label>Estado:</label>
        <select name="id_estado" class="form-control mb-3">
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>
        </select>

        <button class="btn btn-success w-100">Guardar</button>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
