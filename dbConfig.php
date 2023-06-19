<?php

$dbName = "mysql:host=localhost;dbname=imagePosting;charset=utf8";
$userName = "root";

try {
    $db = new PDO($dbName, $userName);
    // echo '<pre>';
    // var_dump("成功");
    // echo '</pre>';
} catch (\Throwable $th) {
    exit();
}
