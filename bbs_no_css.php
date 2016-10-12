<?php
  // ここにDBに登録する処理を記述する
  

  //1.データベースに接続する
  $dsn = 'mysql:dbname=oneline_bbs;host=localhost';   //同じサーバに入っていたらlocalhost
  $user = 'root';   //xampで決まってる
  $password='';     //xampで決まってる
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');    //これがないと文字化けしちゃうよ！

  //POST送信が行われた時
  if(!empty($_POST)){
        $nickname = $_POST['nickname'];
        $comment = $_POST['comment'];     
        //2.SQL文を実行する
        $sql = "INSERT INTO `posts`(`id`, `nickname`, `comment`, `created`) VALUES (null, '".$nickname."', '".$comment."',now())";
        //var_dump($sql); 動いているかを確認するデバッグ
        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
  }
  


  //データベースを切断する
  $dbh = null;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>
</head>
<body>
    <form method="post" action="">
      <p><input type="text" name="nickname" placeholder="nickname" value="<?php echo $nickname; ?>"></p>
      <p><textarea type="text" name="comment" placeholder="comment" value="<?php echo $comment; ?>"></textarea></p>
      <p><button type="submit" >つぶやく</button></p>
    </form>
    <!-- ここにニックネーム、つぶやいた内容、日付を表示する -->
    <p>ニックネーム：<?php echo $nickname; ?></p>
    <p>内容：<?php echo $comment; ?></p>
    <p>日付：<?php echo now(); ?></p>
    
</body>
</html>