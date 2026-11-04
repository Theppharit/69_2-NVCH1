<?php include 'include/head.php'; ?>

<body>
    <?php if ($me) { ?>

        <h1 class=""><?= $me['u_user'] ?></h1>
        <a href="logout.php" class="">ออกจากระบบ</a>

    <?php } else { ?>

        <h1 class="">กรุณาเข้าสู่ระบบ</h1>
        <a href="login.php" class="">เข้าสู่ระบบ</a>

    <?php } ?>
    <!-- ลิงค์ bootstrap js -->
</body>

</html> 