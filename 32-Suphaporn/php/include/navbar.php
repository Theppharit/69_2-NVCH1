<?php $current = basename($_SERVER['PHP_SELF']); ?>
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background: linear-gradient(90deg, #be185d, #ec4899);">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-semibold" href="index.php">Navbar</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#mainMenu" aria-controls="mainMenu"
            aria-expanded="false" aria-label="เปิดเมนู">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $current == 'index.php' ? 'active fw-bold' : '' ?>" href="index.php">หน้าแรก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current == 'p1.php' ? 'active fw-bold' : '' ?>" href="p1.php">หน้า 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current == 'p2.php' ? 'active fw-bold' : '' ?>" href="p2.php">หน้า 2</a>
        </li>
      </ul>

      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-light" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>