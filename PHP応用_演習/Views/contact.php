<!DOCTYPE html>
<html>

<head>
  <?php include('head.php') ?>
</head>

<body>
  <div class='main'>
    <div class='container-fluid'>
      <?php include("header.php") ?>
      
      <div class='row'>
        <form action='confirm.php' method='post'>
          <div>
            <label for='name'>氏名</label>
            <input id='name' type='text' name='name'>
          </div>
          <div>
            <label for='kana'>フリガナ</label>
            <input id='kana' type='text' name='kana'>
          </div>
          <div>
            <label for='tel'>電話番号</label>
            <input id='tel' type='number' name='tel'>
          </div>
          <div>
            <label for='email'>メールアドレス</label>
            <input id='email' type='email' name='email'>
          </div>
          <div>
            <label for='body'>お問い合わせ内容</label>
            <textarea id='body' name='body' placeholder='ご自由に質問を書いてください'></textarea>
          </div>
          <div>
            <input type='submit' value='送信する'>
          </div>
        </form>
      </div>
      
      <?php include('footer.php') ?>
    </div>
  </div>
</body>

</html>
