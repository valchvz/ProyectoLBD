<?php
include '../../includes/header.php';
include '../../includes/database.php';
?>

<div class="container py-4">
    <h2>Servicios Registrados</h2>

    <a href="crear.php" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Nuevo Servicio
    </a>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>

        <?php
        // LLAMAMOS AL PAQUETE
        $sql = "BEGIN PKG_SERVICIO.LISTAR_SERVICIOS(:cursor); END;";
        $stid = oci_parse($conn, $sql);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stid, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stid);
        oci_execute($cursor);

        $hayDatos = false;

        while (($row = oci_fetch_assoc($cursor)) != false) {
            $hayDatos = true;

            echo "
                <tr>
                    <td>{$row['ID_SERVICIO']}</td>
                    <td>{$row['NOMBRE']}</td>
                    <td>{$row['DESCRIPCION']}</td>
                    <td>₡" . number_format($row['PRECIO'], 2) . "</td>
                    <td>" . ($row['ID_ESTADO'] == 1 ? 'Activo' : 'Inactivo') . "</td>
                    <td>
                        <a href='editar.php?id={$row['ID_SERVICIO']}' class='btn btn-warning btn-sm'>Editar</a>
                        <a href='eliminar.php?id={$row['ID_SERVICIO']}' class='btn btn-danger btn-sm'
                           onclick='return confirm(\"¿Eliminar servicio?\")'>Eliminar</a>
                    </td>
                </tr>
            ";
        }

        // SI NO HAY DATOS
        if (!$hayDatos) {
            echo "<tr><td colspan='6' class='text-muted'>No hay servicios registrados.</td></tr>";
        }

        ?>

        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>

