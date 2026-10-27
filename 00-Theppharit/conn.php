<?php

error_reporting(0);
date_default_timezone_set('Asia/Bangkok');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'siammelody';

$conn = mysqli_connect($host, $user, $pass, $dbname);
$conn -> set_charset("utf8");


// <?php include('include/00-head.php'); ? >
// for include/00-navbar.php
//   $sql_main = "SELECT * FROM main_content";
//   $result_main = $conn->query($sql_main);
                // <?php while ($row_main1 = $result_main1->fetch_assoc()) : ? >

                //     <div class="div-index4">

                //         <a href="content.php?act=showbytype&main_id=< ?= $row_main1['main_id']; ? >&main_name=<?= $row_main1['main_name']; ? >">
                //             <img src="assets/img-main/< ?= $row_main1['main_img1']; ? >" alt="">
                //         </a>

                //     </div>

                // < ?php endwhile ? >