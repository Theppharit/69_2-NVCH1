<?php include 'include/head.php';

if (isset($_POST['u_user'])) {
    foreach ($users as $u) {
        if ($u['u_title'] == $_POST['u_title'] && $u['u_detail'] == $_POST['u_detail']) {
            $_SESSION['u_id'] = $u['u_id'];
            if ($u['u_role'] == 'admin') header("Location: admin/admin.php");
            else header("Location: index.php");
            exit();
        }
    }
    $err = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่";
}

?>

<body>
    
<?php if (isset($err)) echo "<div class='alert alert-danger'>$err</div>" ?>

<form action="" method="post">
    <input type="text" name="u_user" placeholder="กรุณากรอกชื่อผู้ใช้" required>
    <input type="password" name="u_pass" placeholder="กรุณากรอกรหัสผ่าน" required>
    <button type="submit">เข้าสู่ระบบ</button>
</form>

<!-- ลิงค์ bootstrap js -->
</body>
</html>