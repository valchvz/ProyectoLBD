<?php include '../includes/header.php'; ?>

<section class="container py-5">
  <h2 class="text-center mb-4">Habitaciones</h2>
  <p class="text-center text-muted mb-5">Elegancia tropical con la comodidad que mereces.</p>

  <div class="row g-4">

    <?php
      $habitaciones = [
        [
          "Habitación Deluxe",
          "https://cf.bstatic.com/xdata/images/hotel/max1024x768/328561205.jpg?k=360692799902626f3c98a1fb42ad834cbf8f1c9df9c5fb9e079047d636b07128&o=",
          "1 cama doble extragrande + 1 cama individual",
          3,
          "₡89,000"
        ],
        [
          "Habitación Doble con terraza",
          "https://cf.bstatic.com/xdata/images/hotel/max1024x768/424147832.jpg?k=81974aa365868908336607c91d067ff72e8826c7a8a4c0e797fe314cc9f9c4e2&o=",
          "1 cama doble",
          2,
          "₡72,000"
        ],
        [
          "Suite",
          "https://cf.bstatic.com/xdata/images/hotel/max1024x768/106275914.jpg?k=6c60fb0a2c20d2d3ada7d818af536a76ab8f04fa97ee370cc0ad2902e1721ead&o=",
          "1 cama extragrande + 1 cama individual",
          3,
          "₡98,000"
        ],
        [
          "Habitación Superior - 1 cama grande",
          "https://cf.bstatic.com/xdata/images/hotel/max1024x768/422487725.jpg?k=5fe350ffc6b1a66eabc77986f1d3b360fccf83a5ffb5fec10129ef16c9978821&o=",
          "1 cama doble",
          2,
          "₡79,000"
        ],
        [
          "Suite Master",
          "https://cf.bstatic.com/xdata/images/hotel/max1024x768/190750790.jpg?k=185c60f9a47f78bd64bce4d7dd2a7a2e18a5127a446188c682ee31b21d6760aa&o=",
          "1 cama individual + 1 cama extragrande",
          3,
          "₡110,000"
        ],
        [
          "Habitación Cuádruple con terraza",
          "https://cf.bstatic.com/xdata/images/hotel/max1024x768/422498945.jpg?k=88d30f231edfaa7fee2fbc6f80af9af619566ad7cd634bcde2b6b47079df2be7&o=https://cf.bstatic.com/xdata/images/hotel/max1024x768/422498945.jpg?k=88d30f231edfaa7fee2fbc6f80af9af619566ad7cd634bcde2b6b47079df2be7&o=",
          "2 camas dobles",
          4,
          "₡134,000"
        ],
        [
          "Suite Familiar",
          "https://cf.bstatic.com/xdata/images/hotel/max1024x768/424147757.jpg?k=0c2ba74b31a3f5992e3e219249c60382356b0ed595113f563a4ac54679cd8e4a&o=",
          "1 individual + 1 extragrande + 1 doble o sofá cama",
          6,
          "₡165,000"
        ]
      ];

      foreach($habitaciones as $h){
        echo "
        <div class='col-md-4'>
          <div class='card shadow-sm h-100'>
            <img src='{$h[1]}' class='card-img-top' style='height:230px; object-fit:cover;'>
            <div class='card-body'>
              <h5 class='card-title'>{$h[0]}</h5>
              <p class='card-text'>{$h[2]}</p>
              <p class='text-muted'>👤 x {$h[3]} huéspedes</p>
              <p class='fw-bold text-success' style='font-size:1.1rem;'>{$h[4]} / noche</p>
              <a href='contacto.php' class='btn btn-hero w-100'>Consultar disponibilidad</a>
            </div>
          </div>
        </div>
        ";
      }
    ?>

  </div>
</section>

<?php include '../includes/footer.php'; ?>
