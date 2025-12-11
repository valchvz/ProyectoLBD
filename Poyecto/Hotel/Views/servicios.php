<?php include '../includes/header.php'; ?>

<section class="container py-5">
  <h2 class="text-center mb-4 fw-bold">Servicios más populares</h2>
  <p class="text-center text-muted mb-5">Servicios pensados para tu confort en La Vela Boutique Hotel.</p>

  <?php
    $servicios = [
      ["Piscina al aire libre", "bi-water"],
      ["Parking gratis", "bi-car-front"],
      ["WiFi gratis", "bi-wifi"],
      ["Habitaciones familiares", "bi-people-fill"],
      ["Traslado aeropuerto", "bi-airplane-fill"],
      ["Restaurante", "bi-egg-fried"],
      ["Habitaciones sin humo", "bi-ban"],
      ["Accesible para movilidad reducida", "bi-person-wheelchair"],
      ["Bar", "bi-cup-straw"],
      ["Muy buen desayuno", "bi-cup-hot-fill"]
    ];
  ?>

  <div class="row g-4 justify-content-center">

    <?php foreach($servicios as $s): ?>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="servicio-box text-center p-4 rounded shadow-sm">
          <i class="bi <?= $s[1] ?> icon-servicio mb-2"></i>
          <p class="mb-0 fw-semibold"><?= $s[0] ?></p>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>

<style>
  .icon-servicio {
    font-size: 2rem;
    color: #1a8f5e;
    display: block;
  }

  .servicio-box {
    background: #ffffff;
    border: 1px solid #ececec;
    transition: all .25s ease-in-out;
    min-height: 130px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .servicio-box:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    background: #f8fcf9;
  }
</style>

<?php include '../includes/footer.php'; ?>
