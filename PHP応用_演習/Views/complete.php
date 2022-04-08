<?php
require_once('../Controllers/ContactController.php');

$contact = new ContactController;

//ダイレクトアクセス禁止
$referer = $_SERVER['HTTP_REFERER'];
$url = "confirm.php";
if (!strstr($referer, $url)) {
    header("Location: contact.php");
    exit;
}

//confirm.phpからのPOSTの値を変数に代入
$name = $contact->escape($_POST['name']);
$kana = $contact->escape($_POST['kana']);
$tel = $contact->escape($_POST['tel']);
$email = $contact->escape($_POST['email']);
$body = $contact->escape($_POST['body']);

//データベースに保存
$contact->create($name, $kana, $tel, $email, $body);

?>

<!DOCTYPE html>
<html>

<head>
  <?php include('head.php') ?>
</head>

<body>
  <div class='main'>
    <div class='container-fluid'>
      <?php include("header.php") ?>

      <div class='row justify-content-center mt-3'>
        <h3>お問い合わせ完了</h3>
      </div>

      <div class='row justify-content-center'>
        <p class='text-center my-3'>
          お問い合わせ内容を送信しました。<br>
          ありがとうございました。
        </p>
      </div>
      
      <div class='row justify-content-center mb-3'>
        <a href="index.php">トップへ戻る</a>
      </div>

      <?php include('footer.php') ?>
    </div>
  </div>
</body>

</html>