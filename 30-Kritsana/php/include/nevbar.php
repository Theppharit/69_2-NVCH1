ื<nav>
    <ul>
        <a href="index.php"class="">หน้าแรก</a>
        <a href="p1.php"class="">หน้า1</a>
        <a href="p2.php"class="">หน้า2</a>
   
    </ul>
    <ul></ul>

     <div class=""></div>
     <div class=""></div>
     
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600&family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

    .custom-navbar {
        font-family: 'Kanit', sans-serif;
        background: linear-gradient(135deg, #ffd1dc 0%, #fef3bd 50%, #d5f4e6 100%) !important;
        box-shadow: 0 4px 15px rgba(255, 182, 193, 0.4);
        padding: 10px 20px;
        border-bottom: 4px solid #fff;
    }
    
    .custom-navbar .navbar-brand {
        font-family: 'Fredoka', 'Kanit', sans-serif;
        font-weight: 600;
        color: #ff6b81 !important;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .mascot-img {
        width: 42px;
        height: 42px;
        object-fit: contain;
        animation: bounce 2s infinite ease-in-out;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-6px) rotate(5deg); }
    }

    .custom-navbar .nav-link {
        color: #555 !important;
        font-weight: 500;
        padding: 8px 18px !important;
        margin: 0 5px;
        border-radius: 25px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background-color: rgba(255, 255, 255, 0.75);
        border: 2px solid transparent;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .custom-navbar .nav-link:hover {
        background-color: #ffffff !important;
        color: #ff6b81 !important;
        transform: translateY(-3px) scale(1.03);
        border-color: #ffb6c1;
        box-shadow: 0 6px 15px rgba(255, 107, 129, 0.2);
    }

    .custom-navbar .nav-link.active {
        background: linear-gradient(45deg, #ff7675, #ff9ff3) !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(255, 118, 117, 0.4);
    }

    /
    .icon-emoji {
        font-size: 1.1rem;
    }
</style>

<?php

$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg custom-navbar sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
        <img src="https://raw.githubusercontent.com/Tarikul-Islam-Ankan/Animated-Fluent-Emojis/master/Emojis/Animals/Bear.png" alt="Bear Mascot" class="mascot-img">
        <span>My Cute World ✨</span>
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">
            <span class="icon-emoji">🏠</span> หน้าแรก
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'p1.php') ? 'active' : ''; ?>" href="p1.php">
            <span class="icon-emoji">🎀</span> หน้า 1
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'p2.php') ? 'active' : ''; ?>" href="p2.php">
            <span class="icon-emoji">🌸</span> หน้า 2
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<nav>