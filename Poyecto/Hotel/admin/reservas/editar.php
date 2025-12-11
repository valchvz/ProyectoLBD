<?php
include '../../includes/header.php';
include '../../includes/database.php';

$id = $_GET['id'];

$sql = "SELECT * FROM TB_RESERVA WHERE ID_RESERVA = :id";
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":id", $id);
oci_execute($stid);

$reserva = oci_fetch_assoc($stid);
?>

<div class="container mt-4">
    <h2 class="fw-bold mb-3">Editar Reserva #<?= $id ?></h2>
    <a href="listar.php" class="btn btn-secondary mb-4">⬅ Volver</a>

    <form method="POST" class="border p-4 shadow rounded bg-white">

        <!-- CLIENTE -->
        <label class="form-label">Cliente:</label>
        <select name="id_cliente" class="form-select" required>
            <option value="">Seleccione...</option>

            <?php
            $q = oci_parse($conn, "SELECT ID_CLIENTE, NOMBRE, PRIMER_APELLIDO FROM TB_CLIENTE");
            oci_execute($q);
            while($row = oci_fetch_assoc($q)){
                $sel = ($row['ID_CLIENTE'] == $reserva['ID_CLIENTE']) ? "selected" : "";
                echo "<option value='{$row['ID_CLIENTE']}' $sel>
                        {$row['NOMBRE']} {$row['PRIMER_APELLIDO']}
                      </option>";
            }
            ?>
        </select>

        <!-- HABITACIÓN -->
        <label class="form-label mt-3">Habitación:</label>
        <select name="num_habitacion" class="form-select" required>

            <?php
            $q = oci_parse($conn, "SELECT NUM_HABITACION FROM TB_HABITACION WHERE ID_ESTADO = 1");
            oci_execute($q);
            while($row = oci_fetch_assoc($q)){
                $sel = ($row['NUM_HABITACION'] == $reserva['NUM_HABITACION']) ? "selected" : "";
                echo "<option value='{$row['NUM_HABITACION']}' $sel>{$row['NUM_HABITACION']}</option>";
            }
            ?>
        </select>

        <!-- FECHAS -->
        <div class="row mt-3">
            <div class="col-md-6">
                <label class="form-label">Fecha entrada:</label>
                <input type="date" name="fecha_inicio" class="form-control"
                       value="<?= substr($reserva['FECHA_ENTRADA'],0,10) ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Fecha salida:</label>
                <input type="date" name="fecha_fin" class="form-control"
                       value="<?= substr($reserva['FECHA_SALIDA'],0,10) ?>" required>
            </div>
        </div>

        <!-- HUESPEDES -->
        <label class="form-label mt-3">Huéspedes:</label>
        <input type="number" name="huespedes" class="form-control"
               value="<?= $reserva['NUM_HUESPEDES'] ?>" required>

        <button type="submit" name="guardar" class="btn btn-primary mt-4 w-100">
            💾 Guardar cambios
        </button>

    </form>
</div>

<?php

// Procesar envío
if (isset($_POST['guardar'])) {

    $sql = "UPDATE TB_RESERVA SET
                ID_CLIENTE     = :c,
                NUM_HABITACION = :h,
                FECHA_ENTRADA  = TO_DATE(:f1, 'YYYY-MM-DD'),
                FECHA_SALIDA   = TO_DATE(:f2, 'YYYY-MM-DD'),
                NUM_HUESPEDES  = :n,
                MODIFICADO_POR = USER,
                FECHA_MODIFICACION = SYSDATE
            WHERE ID_RESERVA = :id";

    $p = oci_parse($conn, $sql);

    oci_bind_by_name($p, ":c", $_POST['id_cliente']);
    oci_bind_by_name($p, ":h", $_POST['num_habitacion']);
    oci_bind_by_name($p, ":f1", $_POST['fecha_inicio']);
    oci_bind_by_name($p, ":f2", $_POST['fecha_fin']);
    oci_bind_by_name($p, ":n", $_POST['huespedes']);
    oci_bind_by_name($p, ":id", $id);

    oci_execute($p);

    echo "<script>alert('Reserva actualizada'); window.location='listar.php';</script>";
}

include '../../includes/footer.php';
?>
