<?php 
include '../../includes/header.php';
include '../../includes/database.php';
?>

<div class="container mt-4">
    <h2 class="fw-bold">Habitaciones Registradas</h2>
    <a href="crear.php" class="btn btn-primary mb-3">+ Nueva Habitación</a>

    <?php
    $sql = "BEGIN PKG_HABITACION.LISTAR_HABITACIONES(:cursor); END;";
    $stid = oci_parse($conn, $sql);

    $cursor = oci_new_cursor($conn);
    oci_bind_by_name($stid, ":cursor", $cursor, -1, OCI_B_CURSOR);

    oci_execute($stid);
    oci_execute($cursor);
    ?>

    <table class="table table-striped shadow">
        <thead class="table-dark">
            <tr>
                <th>Número</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        while ($row = oci_fetch_assoc($cursor)) { 
            ?>
            <tr>
                <td><?= $row['NUM_HABITACION'] ?></td>
                <td><?= $row['TIPO'] ?: "Sin tipo" ?></td>
                <td><?= ($row['ID_ESTADO'] == 1 ? "Activa" : "Inactiva") ?></td>
                <td>
                    <a href="editar.php?id=<?= $row['ID_HABITACION'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="eliminar.php?id=<?= $row['ID_HABITACION'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>
