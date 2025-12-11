<?php 
include '../../includes/header.php';
include '../../includes/database.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2 class="fw-bold">Empleados Registrados</h2>
        <a href="crear.php" class="btn btn-primary">➕ Nuevo Empleado</a>
    </div>

<?php

$sql = "BEGIN PKG_EMPLEADO.LISTAR_EMPLEADOS(:cursor); END;";
$stid = oci_parse($conn, $sql);

$cursor = oci_new_cursor($conn);
oci_bind_by_name($stid, ":cursor", $cursor, -1, OCI_B_CURSOR);

oci_execute($stid);
oci_execute($cursor);

?>

<table class="table table-striped shadow">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Empleado</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Puesto</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>

<?php while ($row = oci_fetch_assoc($cursor)) { ?>
    <tr>
        <td><?= $row['ID_EMPLEADO'] ?></td>
        <td><?= $row['NOMBRE'].' '.$row['PRIMER_APELLIDO'].' '.$row['SEGUNDO_APELLIDO'] ?></td>
        <td><?= $row['CORREO_ELECTRONICO'] ?></td>
        <td><?= $row['NUM_TELEFONO'] ?></td>
        <td><?= $row['PUESTO'] ?></td>
        <td><?= $row['ESTADO'] ?></td>

        <td>
            <a href="editar.php?id=<?= $row['ID_EMPLEADO'] ?>" class="btn btn-warning btn-sm">✏ Editar</a>
            <a href="eliminar.php?id=<?= $row['ID_EMPLEADO'] ?>" class="btn btn-danger btn-sm">🗑 Eliminar</a>
        </td>
    </tr>
<?php } ?>

    </tbody>
</table>

</div>

<?php include '../../includes/footer.php'; ?>
