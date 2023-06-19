<?php
///////////////////////////////////////
//詳細画面＆一覧画面の処理。
//詳細画面なら個別画像のURLを指定
//一覧画面ならデータベースのURLをすべて取り出す
///////////////////////////////////////
$uri = $_SERVER["REQUEST_URI"];

if (strpos($uri, "imageDetail.php") !== false) { //$uriの中にimageDetail.phpが含まれていたら詳細画面にいるので、処理を実行。そうでないならelse以下の処理
    //詳細画面の処理
    $imageId = $_GET["id"];
    $sql = "SELECT * FROM images Where id =" . $imageId;

    $sth = $db->prepare($sql); //準備
    $sth->execute(); //実行
    $data["image"] = $sth->fetch(); //取り出す。data配列の["image"]というキーに代入している。でもこれがなぜ多次元配列にしているのか意味はわからない

    $sql2 = "SELECT * FROM comments WHERE image_id = " . $imageId . " ORDER BY create_date DESC"; //image_idが一致するもののみ取り出す

    $sth = $db->prepare($sql2); //準備
    $sth->execute(); //実行
    $data["comments"] = $sth->fetchALL(); //すべて取り出す
    $countComment = count($data["comments"]); //コメントの数を取り出し

} else {
    //一覧画面の処理。データベースのすべてのデータを取り出して配列に入れる。
    $sql = "SELECT * FROM images ORDER BY create_date DESC";

    $sth = $db->prepare($sql); //準備
    $sth->execute(); //実行
    $data = $sth->fetchALL(); //すべて取り出す

}

return $data;//呼び出し元にどんなデータが保存されているか返すことができる
