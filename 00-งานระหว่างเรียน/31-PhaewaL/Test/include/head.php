<?php
ob_start();
session_start();

//เชื่อมฐานข้อมูล
$conn = mysqli_connect("localhost", "root","", "test_nvc");
mysqli_set_charset($conn, "utf8");

//ดึงข้อมูลจากทุกตารางในฐานข้อมูล
$user = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM test_nvc"), MYSQLI_ASSOC);

//ดูว่าใครล็อคอินอยู่ตอนนี้
$me = noll;
foreach ($user as $u) {
    if (isset($_SESSION['u_id']) && $u)
}






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>