<?php
require_once('../Controllers/ContactController.php');
session_start();

$contacts = new ContactController;
if (!empty($_POST['id'])) {  //編集時
    //編集画面からの$_POSTの値を変数にセット
    $editId = $_POST['id'];
    $editName = $contacts->escape($_POST['name']);
    $editKana = $contacts->escape($_POST['kana']);
    $editTel = $contacts->escape($_POST['tel']);
    $editEmail = $contacts->escape($_POST['email']);
    $editBody = $contacts->escape($_POST['body']);
    //バリデーションチェック
    $_SESSION['editErrors'] = $contacts->validate($editName, $editKana, $editTel, $editEmail, $editBody);

    if (!empty($_SESSION['editErrors'])) {
        //バリデーションチェックの結果を$_SESSIONに保存し、edit.phpでメッセージを表示
        header("Location: edit.php?id={$editId}");
        $_SESSION['editName'] = $contacts->escape($_POST['name']);
        $_SESSION['editKana'] = $contacts->escape($_POST['kana']);
        $_SESSION['editTel'] = $contacts->escape($_POST['tel']);
        $_SESSION['editEmail'] = $contacts->escape($_POST['email']);
        $_SESSION['editBody'] = $contacts->escape($_POST['body']);
    } else {
        //編集時にエラーがなければ更新
        $contacts->update($editId, $editName, $editKana, $editTel, $editEmail, $editBody);
        //入力画面にリダイレクトした際にフォームに値が入らないようにnullを代入
        $name = null;
        $kana = null;
        $tel = null;
        $email = null;
        $body = null;
    }
} elseif (!empty($_SESSION['errors'])) {  //contact.phpでエラーがあった場合
    //確認画面(confirm.php)でのバリデーションチェックの結果を変数に代入
    $errors = $_SESSION['errors'];
    //contact.phpからconfirm.phpに送られた$_POSTの値を表示する(confirm.php:23~27)
    $name = $_SESSION["name"];
    $kana = $_SESSION["kana"];
    $tel = $_SESSION["tel"];
    $email = $_SESSION["email"];
    $body = $_SESSION["body"];
} elseif (!empty($_POST)) {  //confirm.phpでキャンセル時
    $name = $contacts->escape($_POST['name']);
    $kana = $contacts->escape($_POST['kana']);
    $tel = $contacts->escape($_POST['tel']);
    $email = $contacts->escape($_POST['email']);
    $body = $contacts->escape($_POST['body']);
} else {
    //$_POST, $_SESSIONに値がなければ(通常時)、変数にnullを代入
    $name = null;
    $kana = null;
    $tel = null;
    $email = null;
    $body = null;
}
//一覧表示
$result = $contacts->index();

?>

<!DOCTYPE html>
<html>

<head>
  <?php include('head.php'); ?>
  <script defer src="../js/validation.js"></script>
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

          <?php ?>
          <label for='name' class='col-6 offset-3 mt-2'>氏名</label>
          <input id='name' type='text' name='name' placeholder='例）山田太郎' value="<?php echo $name ?>" class='col-6 offset-3 form-control'>
          <?php if (!empty($errors['name'])) : ?>
            <p class='col-6 offset-3' style='color: red;'><?php echo $errors['name'] ?></p>
          <?php endif ?>

          <label for='kana' class='col-6 offset-3 mt-2'>フリガナ</label>
          <input id='kana' type='text' name='kana' placeholder='例）ヤマダタロウ' value="<?php echo $kana ?>" class='col-6 offset-3 form-control'>
          <?php if (!empty($errors['kana'])) : ?>
             <p class='col-6 offset-3' style='color: red;'><?php echo $errors['kana'] ?></p>
          <?php endif ?>

          <label for='tel' class='col-6 offset-3 mt-2'>電話番号</label>
          <input id='tel' type='number' name='tel' placeholder='例）08011111111' value="<?php echo $tel ?>" class='col-6 offset-3 form-control'>
          <?php if (!empty($errors['tel'])) : ?>
             <p class='col-6 offset-3' style='color: red;'><?php echo $errors['tel'] ?></p>
          <?php endif ?>

          <label for='email' class='col-6 offset-3 mt-2'>メールアドレス</label>
          <input id='email' type='email' name='email' placeholder='例）yamada@example.com' value="<?php echo $email ?>" class='col-6 offset-3 form-control'>
          <?php if (!empty($errors['email'])) : ?>
             <p class='col-6 offset-3' style='color: red;'><?php echo $errors['email'] ?></p>
          <?php endif ?>

          <label for='body' class='col-6 offset-3 mt-2'>お問い合わせ内容</label>
          <textarea id='body' name='body' placeholder='ご自由に質問を書いてください' class='col-6 offset-3 form-control' rows='5'><?php echo strip_tags($body) ?></textarea>
          <?php if (!empty($errors['body'])) : ?>
             <p class='col-6 offset-3' style='color: red;'><?php echo $errors['body'] ?></p>
          <?php endif ?>

          <input id='submit' type='submit' value='確認する' class='button col-2 offset-5 my-3 btn-success'>

        </form>
        <!-- エラーメッセージが残るため、contact.phpで入力した値でのバリデーションチェックのエラーをリセットする -->
        <?php if (!empty($_SESSION['errors'])) : ?>
            <?php session_destroy(); ?>
        <?php endif ?>
      </div>
      
      <div class='row justify-content-center mx-3'>
        <table class='table'>
          <thead>
            <tr>
              <th style='width: 15%'>氏名</th>
              <th style='width: 15%'>フリガナ</th>
              <th style='width: 10%'>電話番号</th>
              <th style='width: 20%'>メールアドレス</th>
              <th style='width: 30%'>お問い合わせ内容</th>
              <th style='width: 10%'></th>
            </tr>
            <?php foreach ($result['contacts'] as $contact) : ?>
            <tr>
              <td class='text-nowrap'><?php echo $contact['name'] ?></td>
              <td class='text-nowrap'><?php echo $contact['kana'] ?></td>
              <td><?php echo $contact['tel'] ?></td>
              <td><?php echo $contact['email'] ?></td>
              <td class='text-wrap'><?php echo nl2br($contact['body']) ?></td>
              <td>
                <button onclick="location.href='edit.php?id=<?php echo $contact['id'] ?>'" class='button btn-primary'>編集</button>
                <button onclick="location.href='delete.php?id=<?php echo$contact['id'] ?>&page=<?php echo $result['page'] ?>'; return confirm('本当に削除しますか？')" class='button btn-danger'>削除</button>
              </td>
            </tr>
            <?php endforeach ?>
          </thead>
        </table>
      </div>

      <?php include('footer.php') ?>
    </div>
  </div>
</body>

</html>
