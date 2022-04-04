<?php
require_once('../Controllers/ContactController.php');

$contacts = new ContactController;
$result = $contacts->index();

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
        <h3>お問い合わせフォーム</h3>
      </div>

      <div class='row'>
        <form action='confirm.php' method='post' class='row'>

          <label for='name' class='col-6 offset-3 mt-2'>氏名</label>
          <input id='name' type='text' name='name' placeholder='例）山田太郎' class='col-6 offset-3 form-control'>

          <label for='kana' class='col-6 offset-3 mt-2'>フリガナ</label>
          <input id='kana' type='text' name='kana' placeholder='例）ヤマダタロウ' class='col-6 offset-3 form-control'>

          <label for='tel' class='col-6 offset-3 mt-2'>電話番号</label>
          <input id='tel' type='number' name='tel' placeholder='例）08011111111' class='col-6 offset-3 form-control'>

          <label for='email' class='col-6 offset-3 mt-2'>メールアドレス</label>
          <input id='email' type='email' name='email' placeholder='例）yamada@example.com' class='col-6 offset-3 form-control'>

          <label for='body' class='col-6 offset-3 mt-2'>お問い合わせ内容</label>
          <textarea id='body' name='body' placeholder='ご自由に質問を書いてください' class='col-6 offset-3 form-control' rows='5'></textarea>

          <input type='submit' value='確認する' class='button col-2 offset-5 my-3 btn-success'>

        </form>
      </div>

      <div class='row justify-content-center mx-3'>
        <table class='table'>
          <thead>
            <tr>
              <th>氏名</th>
              <th>フリガナ</th>
              <th>電話番号</th>
              <th>メールアドレス</th>
              <th>お問い合わせ内容</th>
              <th></th>
            </tr>
            <tr>
              <?php foreach ($result['contacts'] as $contact) : ?>
              <td><?php echo $contact['name'] ?></td>
              <td><?php echo $contact['kana'] ?></td>
              <td><?php echo $contact['tel'] ?></td>
              <td><?php echo $contact['email'] ?></td>
              <td><?php echo $contact['body'] ?></td>
              <td>
                <button href="edit.php?id=<?php $contact['id'] ?>" class='button btn-primary'>編集</button>
                <button href="delete.php?id=<?php $contact['id'] ?>&page=<?php $result['page'] ?>" class='button btn-danger' onclick="return confirm('本当に削除しますか？')">削除</button>
              </td>
              <?php endforeach ?>
            </tr>
          </thead>
        </table>
      </div>

      <?php include('footer.php') ?>
    </div>
  </div>
</body>

</html>
