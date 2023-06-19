<?php
include("./dbConfig.php"); //データベースと接続

$targetDirectory = "images/"; //画像の保存ディレクトリを指定
$fileName = basename($_FILES["file"]["name"]); //スーパーグローバル変数でフォームにアップロードされたファイル名を読み取り
$targetFilePath = $targetDirectory . $fileName; //images/testみたいなファイルパスができる
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); //画像の拡張子を読み取りに行く
$imageId = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($fileName)) { //postImageForm.phpからPOSTされているか確認。またファイルネームがから出ないかも確認
    $arrImageTypes = array("jpg", "png", "jpeg", "gif", "pdf");
    if (in_array($fileType, $arrImageTypes)) { //in_arrayは画像の拡張子が指定した配列の拡張子に含まれているか確認
        $sql = "SELECT file_name FROM images WHERE id =" . $imageId;

        $sth = $db->prepare($sql); //準備
        $sth->execute(); //実行
        $getImageName = $sth->fetch(); //取り出す

        $deleteImage = unlink($targetDirectory . $getImageName['file_name']); //画像ファイルを削除

        if ($deleteImage) { //$deleteImageが真なら
            $uploadImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath); //画像ファイルを一次保存

            if ($uploadImageForServer) {
                $update = $db->query("UPDATE images SET file_name= '" . $fileName . "' WHERE id =" . $imageId); //imagesテーブルに保存

                header("Location:" . "./html/index.php", true, 303);
                exit();
            }
        }
    }
}
