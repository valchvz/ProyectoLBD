<?php
include '../../includes/header.php';
include '../../includes/database.php';
?>

<div class="container mt-4">
    <h2 class="fw-bold mb-3">Crear Reserva</h2>
    <a href="listar.php" class="btn btn-secondary mb-4">⬅ Volver al listado</a>

    <form method="POST" class="border p-4 shadow rounded bg-white">

        <!-- CLIENTE -->
        <label class="form-label">Cliente:</label>
        <select name="id_cliente" class="form-select" required>
            <option value="">Seleccione un cliente</option>

            <?php
            $sql = "SELECT ID_CLIENTE, NOMBRE, PRIMER_APELLIDO FROM TB_CLIENTE WHERE ID_ESTADO = 1";
            $stid = oci_parse($conn, $sql);
            oci_execute($stid);

            while($row = oci_fetch_assoc($stid)){
                echo "<option value='{$row['ID_CLIENTE']}'>
                        {$row['NOMBRE']} {$row['PRIMER_APELLIDO']}
                      </option>";
            }
            ?>
        </select>

        <!-- HABITACIÓN -->
        <label class="form-label mt-3">Habitación:</label>
        <select name="num_habitacion" class="form-select" required>
            <option value="">Seleccione una habitación</option>

            <?php
            $sql = "SELECT NUM_HABITACION FROM TB_HABITACION WHERE ID_ESTADO = 1 ORDER BY NUM_HABITACION";
            $stid = oci_parse($conn, $sql);
            oci_execute($stid);

            while($row = oci_fetch_assoc($stid)){
                echo "<option value='{$row['NUM_HABITACION']}'>{$row['NUM_HABITACION']}</option>";
            }
            ?>
        </select>

        <!-- FECHAS -->
        <div class="row mt-3">
            <div class="col-md-6">
                <label class="form-label">Fecha entrada:</label>
                <input type="date" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Fecha salida:</label>
                <input type="date" name="fecha_fin" class="form-control" required>
            </div>
        </div>

        <!-- HUESPEDES -->
        <label class="form-label mt-3">Número de huéspedes:</label>
        <input type="number" name="huespedes" min="1" class="form-control" required>

        <button type="submit" name="guardar" class="btn btn-success mt-4 w-100">
            💾 Guardar Reserva
        </button>

    </form>

</div>


<!-- PROCESAR FORMULARIO -->
<?php
if (isset($_POST['guardar'])) {

    $id_cliente      = $_POST['id_cliente'];
    $num_habitacion  = $_POST['num_habitacion'];
    $f_inicio        = $_POST['fecha_inicio'];
    $f_fin           = $_POST['fecha_fin'];
    $huespedes       = $_POST['huespedes'];

    $sql = "BEGIN PK_RESERVA.INS_RESERVA(:p_cliente, :p_hab, TO_DATE(:f1,'YYYY-MM-DD'),
                                        TO_DATE(:f2,'YYYY-MM-DD'), :huesp, :id_out); END;";

    $stid = oci_parse($conn, $sql);

    oci_bind_by_name($stid, ':p_cliente', $id_cliente);
    oci_bind_by_name($stid, ':p_hab', $num_habitacion);
    oci_bind_by_name($stid, ':f1', $f_inicio);
    oci_bind_by_name($stid, ':f2', $f_fin);
    oci_bind_by_name($stid, ':huesp', $huespedes);
    oci_bind_by_name($stid, ':id_out', $id_new_res, 32);

    $r = @oci_execute($stid);

    if (!$r) {
        $e = oci_error($stid);
        echo "<div class='alert alert-danger mt-4'>
                ❌ Error: {$e['message']}
              </div>";
    } else {
        echo "<div class='alert alert-success mt-4'>
                ✔ Reserva creada exitosamente. ID: <b>$id_new_res</b>
              </div>";

        echo "<script>
                setTimeout(()=>{ window.location='listar.php'; }, 2000);
              </script>";
    }

}
?>

<?php include '../../includes/footer.php'; ?>
