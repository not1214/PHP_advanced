<?php
require_once('../Controllers/ContactController.php');

$contact = new ContactController;

$name = $_POST['name'];
$kana = $_POST['kana'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$body = $_POST['body'];

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