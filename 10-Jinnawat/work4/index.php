<<<<<<< Updated upstream
<?php include 'include/head.php'; ?>

<body>

<?php include 'include/navbar.php'; ?>

<section>

<?php while ($row = $result_d->fetch_assoc()) { ?>

    <h1 class="display-1 text-center m-5"><?php echo $row['d_title']; ?></h1>

<?php } ?>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner w-50 m-auto">
    <div class="carousel-item active">
      <img src="img/11.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/12.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/13.jpg" class="d-block w-100" alt="...">
=======
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">หน้าแรก</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">หน้าแรก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="p1.php">หน้าที่ 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="p2.php">หน้าที่ 2</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ตัวเลือกเพิ่มเติม
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="index.php">หน้าแรก</a></li>
            <li><a class="dropdown-item" href="p1.php">หน้าที่ 1</a></li>
            <li><a class="dropdown-item" href="p2.php">หน้าที่ 2</a></li>
          </ul>
        </li>
      </ul>
>>>>>>> Stashed changes
    </div>
  </div>
</nav>