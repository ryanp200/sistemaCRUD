<?php
    $pwd = "";
    $server= "localhost";
    $user = "root";
    $db = "escola_zedong";

    $con = mysqli_connect($server, $user, $pwd, $db) or die("Falha ou erro de conexão: ".mysqli_connect_error());
    mysqli_set_charset($con, "utf8mb4");
?>