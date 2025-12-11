<?php 
include '../../includes/header.php';
include '../../includes/database.php';
?>

<div class="container col-md-6 mt-4">

<h2 class="fw-bold mb-3">Registrar Cliente</h2>

<?php
if ($_POST) {
    $sql = "BEGIN PKG_CLIENTE.INS_CLIENTE(:n, :ap1, :ap2, :c, :t, :tipo, :estado, :outid); END;";
    $stid = oci_parse($conn, $sql);

    oci_bind_by_name($stid, ":n", $_POST['nombre']);
    oci_bind_by_name($stid, ":ap1", $_POST['ap1']);
    oci_bind_by_name($stid, ":ap2", $_POST['ap2']);
    oci_bind_by_name($stid, ":c", $_POST['correo']);
    oci_bind_by_name($stid, ":t", $_POST['telefono']);
    oci_bind_by_name($stid, ":tipo", $_POST['tipo_cliente']);

    $estado = 1;
    oci_bind_by_name($stid, ":estado", $estado);

    $outid = 0;
    oci_bind_by_name($stid, ":outid", $outid, 32);

    oci_execute($stid);

    echo "<div class='alert alert-success'>Cliente creado con ID: <b>$outid</b></div>";
}
?>

<form method="POST" class="card p-4 shadow">

    <label>Nombre:</label>
    <input type="text" name="nombre" class="form-control" required>

    <label class="mt-2">Primer apellido:</label>
    <input type="text" name="ap1" class="form-control" required>

    <label class="mt-2">Segundo apellido:</label>
    <input type="text" name="ap2" class="form-control" required>

    <label class="mt-2">Correo:</label>
    <input type="email" name="correo" class="form-control" required>

    <label class="mt-2">Teléfono:</label>
    <input type="text" name="telefono" class="form-control" required>

    <label class="mt-2">Tipo de cliente (ID):</label>
    <input type="number" name="tipo_cliente" class="form-control" required>

    <button class="btn btn-success mt-3">Guardar</button>

</form>
</div>

<?php include '../../includes/footer.php'; ?>
