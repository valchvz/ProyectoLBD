<?php
include '../../includes/header.php';
include '../../includes/database.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Reservas</h2>
        <a href="crear.php" class="btn btn-primary">➕ Nueva Reserva</a>
    </div>

<?php
$sql = "BEGIN PK_RESERVA.LISTAR_RESERVAS(:cursor); END;";
$stid = oci_parse($conn, $sql);

$cursor = oci_new_cursor($conn);
oci_bind_by_name($stid, ":cursor", $cursor, -1, OCI_B_CURSOR);

oci_execute($stid);
oci_execute($cursor);
?>

<table class="table table-striped shadow text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Habitación</th>
            <th>Entrada</th>
            <th>Salida</th>
            <th>Huéspedes</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
    <?php while ($row = oci_fetch_assoc($cursor)) { ?>

        <tr>
            <td><?= $row['ID_RESERVA'] ?></td>
            <td><?= $row['CLIENTE'] ?></td>
            <td><?= $row['NUM_HABITACION'] ?></td>
            <td><?= $row['FECHA_ENTRADA'] ?></td>
            <td><?= $row['FECHA_SALIDA'] ?></td>
            <td><?= $row['NUM_HUESPEDES'] ?></td>

            <td>
                <?= $row['ID_ESTADO'] == 1 ? "<span class='badge bg-success'>Activa</span>"
                                            : "<span class='badge bg-secondary'>Cancelada</span>" ?>
            </td>

            <td>
                <a href="editar.php?id=<?= $row['ID_RESERVA'] ?>" class="btn btn-warning btn-sm">✏ Editar</a>
                <a href="eliminar.php?id=<?= $row['ID_RESERVA'] ?>" class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Eliminar reserva?')">🗑 Eliminar</a>
            </td>
        </tr>

    <?php } ?>
    </tbody>
</table>

</div>

<?php include '../../includes/footer.php'; ?>
