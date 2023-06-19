<?php
include("./dbConfig.php"); //データベースと接続

$targetDirectory = "images/"; //画像の保存ディレクトリを指定
$fileName = basename($_FILES["file"]["name"]); //スーパーグローバル変数でフォームにアップロードされたファイル名を読み取り
$targetFilePath = $targetDirectory . $fileName; //images/testみたいなファイルパスができる
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); //画像の拡張子を読み取りに行く

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($fileName)) { //postImageForm.phpからPOSTされているか確認。またファイルネームがから出ないかも確認
    $arrImageTypes = array("jpg", "png", "jpeg", "gif", "pdf");
    if (in_array($fileType, $arrImageTypes)) { //in_arrayは画像の拡張子が指定した配列の拡張子に含まれているか確認
        $postImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath); //画像ファイルを一次保存
        if ($postImageForServer) {
            $insert = $db->query("INSERT INTO images(file_name)VALUES('" . $fileName . "')"); //imagesテーブルに保存
        }
    }
}

header("Location:" . "./html/index.php", true, 303);
exit();
