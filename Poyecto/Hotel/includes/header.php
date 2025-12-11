<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>La Vela Boutique Hotel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons (LO QUE FALTABA) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="/Hotel/css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/hotel/index.php" style="color:#0E6251;">
      La Vela Boutique Hotel
    </a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="/hotel/views/home.php">Inicio</a></li>
      <li class="nav-item"><a class="nav-link" href="/hotel/views/habitaciones.php">Habitaciones</a></li>
      <li class="nav-item"><a class="nav-link" href="/hotel/views/servicios.php">Servicios</a></li>
      <li class="nav-item"><a class="nav-link" href="/hotel/views/galeria.php">Galería</a></li>
      <li class="nav-item"><a class="nav-link" href="/hotel/views/ubicacion.php">Ubicación</a></li>
      <li class="nav-item"><a class="nav-link" href="/hotel/views/contacto.php">Contacto</a></li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-success fw-bold" href="#" role="button" data-bs-toggle="dropdown">
          Administración
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/Hotel/admin/cliente/listar.php">Clientes</a></li>
          <li><a class="dropdown-item" href="/Hotel/admin/empleado/listar.php">Empleados</a></li>
          <li><a class="dropdown-item" href="/Hotel/admin/habitacion/listar.php">Habitaciones</a></li>
          <li><a class="dropdown-item" href="/Hotel/admin/reservas/listar.php">Reservas</a></li>
          <li><a class="dropdown-item" href="/Hotel/admin/servicios/listar.php">Servicios</a></li>
        </ul>
      </li>

    </ul>
  </div>
</nav>
