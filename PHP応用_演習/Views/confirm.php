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
        <form action='complete.php' method='post' class='row'>

          <p class='col-6 offset-3 mt-2'>氏名</p>
          <p class='col-6 offset-3'><?php echo $_POST['name'] ?></p>

          <p class='col-6 offset-3 mt-2'>フリガナ</p>
          <p class='col-6 offset-3'><?php echo $_POST['kana'] ?></p>

          <p class='col-6 offset-3 mt-2'>電話番号</p>
          <p class='col-6 offset-3'><?php echo $_POST['tel'] ?></p>


          <p class='col-6 offset-3 mt-2'>メールアドレス</p>
          <p class='col-6 offset-3'><?php echo $_POST['email'] ?></p>

          <p class='col-6 offset-3 mt-2'>お問い合わせ内容</p>
          <p class='col-6 offset-3'><?php echo $_POST['body'] ?></p>

          <div class='col-12 my-3'>
            <input type='button' value='キャンセル' class='button col-2 offset-4 btn-danger' onclick="history.back()">
            <input type='submit' value='送信する' class='button col-2 btn-success ml-3'>
          </div>
        
        </form>
      </div>

      <?php include('footer.php') ?>
    </div>
  </div>
</body>

</html>
