<?php include 'include/head.php'; ?>

<body>
    <?php if ($me) { ?>

        <h1 class=""><?= $me['u_user'] ?></h1>
        <a href="logout.php" class="">ออกจากระบบ</a>

    <?php } ?>
    <!-- ลิงค์ bootstrap js -->
</body>

</html>