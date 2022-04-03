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
        <h3>お問い合わせフォーム</h3>
      </div>

      <div class='row'>
        <form action='confirm.php' method='post' class='row'>

          <label for='name' class='col-6 offset-3 mt-2'>氏名</label>
          <input id='name' type='text' name='name' class='col-6 offset-3 form-control'>

          <label for='kana' class='col-6 offset-3 mt-2'>フリガナ</label>
          <input id='kana' type='text' name='kana' class='col-6 offset-3 form-control'>

          <label for='tel' class='col-6 offset-3 mt-2'>電話番号</label>
          <input id='tel' type='number' name='tel' class='col-6 offset-3 form-control'>

          <label for='email' class='col-6 offset-3 mt-2'>メールアドレス</label>
          <input id='email' type='email' name='email' class='col-6 offset-3 form-control'>

          <label for='body' class='col-6 offset-3 mt-2'>お問い合わせ内容</label>
          <textarea id='body' name='body' placeholder='ご自由に質問を書いてください' class='col-6 offset-3 form-control' rows='5'></textarea>

          <input type='submit' value='確認する' class='button col-2 offset-5 my-3 btn-success'>

        </form>
      </div>

      <?php include('footer.php') ?>
    </div>
  </div>
</body>

</html>
