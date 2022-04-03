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
          <input id='name' type='text' name='name' value='' class='col-6 offset-3 form-control'>

          <label for='kana' class='col-6 offset-3 mt-2'>フリガナ</label>
          <input id='kana' type='text' name='kana' value='' class='col-6 offset-3 form-control'>

          <label for='tel' class='col-6 offset-3 mt-2'>電話番号</label>
          <input id='tel' type='number' name='tel' value='' class='col-6 offset-3 form-control'>

          <label for='email' class='col-6 offset-3 mt-2'>メールアドレス</label>
          <input id='email' type='email' name='email' value='' class='col-6 offset-3 form-control'>

          <label for='body' class='col-6 offset-3 mt-2'>お問い合わせ内容</label>
          <textarea id='body' name='body' placeholder='ご自由に質問を書いてください' value='' class='col-6 offset-3 form-control' rows='5'></textarea>

          <p class='col-12 text-center mt-3'>上記内容でよろしいでしょうか？</p>
          
          <div class='col-12 my-3'>
            <input type='button' href='contact.php' value='キャンセル' class='button col-2 offset-4 btn-danger' onclick="history.back()">
            <input type='submit' value='更新する' class='button col-2 ml-3 btn-success'>
          </div>
        </form>
      </div>

      <?php include('footer.php') ?>
    </div>
  </div>
</body>

</html>