<?php

include("./dbConfig.php");
$imageId = $_GET["image_id"];
$comment = $_POST["comment"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($comment)) {
    $insert = $db->query("INSERT INTO comments (image_id,comment)VALUES(" . $imageId . ",'" . $comment . "')");
    if ($insert) {
        $uri = $_SERVER["HTTP_REFERER"]; //どのページから来たかを確認できる
        header("Location:" . $uri, true, 303);
        exit();
    }
} else {
    //入力分がない場合は元の画面に戻る
    $uri = $_SERVER["HTTP_REFERER"]; //どのページから来たかを確認できる
    header("Location:" . $uri, true, 303);
    exit();
};
