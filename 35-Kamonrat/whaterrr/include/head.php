<?php
ob_start();
session_start();

// เชื่อมฐานข้อมูล
$conn = mysqli_connect("localhost", "root", "", "nvc");
mysqli_set_charset($conn, "utf8");

// ดึงข้อมูลจากทุกตารางในฐานข้อมูล
$users = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM data"), MYSQLI_ASSOC);

// ดูว่าใครล็อคอินอยู่ตอนนี้
$me = null;
foreach ($users as $u) {
    if (isset($_SESSION['U_id']) && $u['U_id'] == $_SESSION['U_id'])
        $me = $u;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


