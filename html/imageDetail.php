<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>画像投稿アプリ</title>
</head>

<body>
  <?php include('../dbConfig.php') ?>
  <?php include('../getDatas.php') ?>
  <?php include('./header.php') ?>
  <div class="detailImageBox">
    <div class="detailImage">
      <img src="../images/<?php echo $data["image"]["file_name"]; ?>" alt="投稿画像">
      <div class="detailImagButton">
        <button class="updateButton" onclick="location.href='./postImageForm.php?id=<?php echo $_GET['id']; ?>';">更新</button>
        <button class="deleteButton" onclick="location.href='../deleteImage.php?id=<?php echo $_GET['id']; ?>';">削除</button>
      </div>
      <button onclick="location.href='./index.php';">戻る</button>
    </div>
    <div class="comment">
      <p class="commentTitle">コメント</p>
      <ul>
        <?php for ($i = 0; $i < $countComment; $i++) { ?>
          <li><?php echo $data["comments"][$i]["comment"]; ?></li><!--多次元配列から指定 -->
        <?php } ?>
      </ul>
      <div class="submitComment">
        <form action="../postComment.php?image_id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
          <textarea name="comment" id="comment" cols="40" rows="10"></textarea>
          <button type="submit" name="submit">送信</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>