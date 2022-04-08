<?php
require_once('../Controllers/ContactController.php');
session_start();

$contact = new ContactController;

$referer = $_SERVER['HTTP_REFERER'];
$url = "contact.php";
if (!strstr($referer, $url)) {
    header("Location: contact.php");
    exit;
}

$name = $contact->escape($_POST['name']);
$kana = $contact->escape($_POST['kana']);
$tel = $contact->escape($_POST['tel']);
$email = $contact->escape($_POST['email']);
$body = $contact->escape($_POST['body']);

$_SESSION['errors'] = $contact->validate($name, $kana, $tel, $email, $body);
if (!empty($_SESSION['errors'])) {
    header('Location: contact.php');
    $_SESSION['name'] = $contact->escape($_POST['name']);
    $_SESSION['kana'] = $contact->escape($_POST['kana']);
    $_SESSION['tel'] = $contact->escape($_POST['tel']);
    $_SESSION['email'] = $contact->escape($_POST['email']);
    $_SESSION['body'] = $contact->escape($_POST['body']);
}

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
        <h3>お問い合わせ内容確認</h3>
      </div>

      <div class='row'>

        <p class='col-6 offset-3 mt-2'>氏名</p>
        <p class='col-6 offset-3'><?php echo $name ?></p>

        <p class='col-6 offset-3 mt-2'>フリガナ</p>
        <p class='col-6 offset-3'><?php echo $kana ?></p>

        <p class='col-6 offset-3 mt-2'>電話番号</p>
        <p class='col-6 offset-3'><?php echo $tel ?></p>


        <p class='col-6 offset-3 mt-2'>メールアドレス</p>
        <p class='col-6 offset-3'><?php echo $email ?></p>

        <p class='col-6 offset-3 mt-2'>お問い合わせ内容</p>
        <p class='col-6 offset-3'><?php echo nl2br($body) ?></p>

        <div class='d-inline-flex col-12 my-3'>
          <form action='contact.php' method='post' class='col-2 offset-4'>
            <input type='button' value='キャンセル' class='button btn-danger' onclick="history.back()">
            <input type='hidden' name='name' value="<?php echo $name ?>">
            <input type='hidden' name='kana' value="<?php echo $kana ?>">
            <input type='hidden' name='tel' value="<?php echo $tel ?>">
            <input type='hidden' name='email' value="<?php echo $email ?>">
            <input type='hidden' name='body' value="<?php echo $body ?>">
          </form>
          <form action='complete.php' method='post' class='ml-3'>
            <input name='submit' type='submit' value='送信する' class='button btn-success ml-3'>
            <input type='hidden' name='name' value="<?php echo $name ?>">
            <input type='hidden' name='kana' value="<?php echo $kana ?>">
            <input type='hidden' name='tel' value="<?php echo $tel ?>">
            <input type='hidden' name='email' value="<?php echo $email ?>">
            <input type='hidden' name='body' value="<?php echo strip_tags(nl2br($body)) ?>">
          </form>
        </div>
      </div>
    </div>

    <?php include('footer.php') ?>
  </div>
</body>

</html>
