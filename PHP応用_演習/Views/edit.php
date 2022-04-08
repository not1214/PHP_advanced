<?php
require_once('../Controllers/ContactController.php');
session_start();

$contact = new ContactController;
$id = $_GET['id'];
$result = $contact->edit($id);
if (!empty($result)) {
    $name = $result['name'];
    $kana = $result['kana'];
    $tel = $result['tel'];
    $email = $result['email'];
    $body = $result['body'];
}

if (!empty($_SESSION['editErrors'])) {
    $errors = $_SESSION['editErrors'];
    $name = $_SESSION['editName'];
    $kana = $_SESSION['editKana'];
    $tel = $_SESSION['editTel'];
    $email = $_SESSION['editEmail'];
    $body = $_SESSION['editBody'];
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
        <h3>お問い合わせ内容編集</h3>
      </div>

      <div class='row'>
        <form action='contact.php' method='post' class='row'>
         
          <label for='name' class='col-6 offset-3 mt-2'>氏名</label>
          <input id='name' type='text' name='name' value="<?php echo $name ?>" class='col-6 offset-3 form-control'>
          <?php if (!empty($errors['name'])) : ?>
            <p class='col-6 offset-3' style='color: red;'><?php echo $errors['name'] ?></p>
          <?php endif ?>

          <label for='kana' class='col-6 offset-3 mt-2'>フリガナ</label>
          <input id='kana' type='text' name='kana' value="<?php echo $kana ?>" class='col-6 offset-3 form-control'>
          <?php if (!empty($errors['kana'])) : ?>
             <p class='col-6 offset-3' style='color: red;'><?php echo $errors['kana'] ?></p>
          <?php endif ?>

          <label for='tel' class='col-6 offset-3 mt-2'>電話番号</label>
          <input id='tel' type='number' name='tel' value="<?php echo $tel ?>" class='col-6 offset-3 form-control'>
          <?php if (!empty($errors['tel'])) : ?>
             <p class='col-6 offset-3' style='color: red;'><?php echo $errors['tel'] ?></p>
          <?php endif ?>

          <label for='email' class='col-6 offset-3 mt-2'>メールアドレス</label>
          <input id='email' type='email' name='email' value="<?php echo $email ?>" class='col-6 offset-3 form-control'>
          <?php if (!empty($errors['email'])) : ?>
             <p class='col-6 offset-3' style='color: red;'><?php echo $errors['email'] ?></p>
          <?php endif ?>

          <label for='body' class='col-6 offset-3 mt-2'>お問い合わせ内容</label>
          <textarea type='text' id='body' name='body' class='col-6 offset-3 form-control' rows='5'><?php echo strip_tags(nl2br($body)) ?></textarea>
          <?php if (!empty($errors['body'])) : ?>
             <p class='col-6 offset-3' style='color: red;'><?php echo $errors['body'] ?></p>
          <?php endif ?>

          <p class='col-12 text-center mt-3'>上記内容でよろしいでしょうか？</p>
          
          <div class='col-12 my-3'>
            <input type='button' href='contact.php' value='キャンセル' class='button col-2 offset-4 btn-danger' onclick="history.back()">
            <input type='submit' value='更新する' class='button col-2 ml-3 btn-success'>
            <input type='hidden' name='id' value="<?php echo $id ?>">
          </div>
        
        </form>
        <?php session_destroy(); ?>
      </div>

      <?php include('footer.php') ?>
    </div>
  </div>
</body>

</html>