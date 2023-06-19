<?php
include("./dbConfig.php");

$targetDirectory = "images/";
$imageId = $_GET["id"];

if (!empty($imageId)) { //imageIdが空でなければ
    $sql = "SELECT file_name FROM images WHERE id =" . $imageId;

    $sth = $db->prepare($sql); //準備
    $sth->execute(); //実行
    $getImageName = $sth->fetch(); //すべて取り出す

    $deleteImage = unlink($targetDirectory . $getImageName['file_name']);

    if ($deleteImage) { //$deleteImageが真なら
        $deleteRecord = $db->query("DELETE FROM images WHERE id=" . $imageId); //変数に処理を代入すると処理は実行される

        if ($deleteRecord) { //処理が実行できたら
            header('Location:' . './html/index.php', true, 303);
            exit();
        }
    }
}
