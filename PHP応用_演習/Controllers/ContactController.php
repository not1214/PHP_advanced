<?php
require_once('../Models/Contact.php');

class ContactController
{
    private $request;  //リクエストパラメータ(GET,POST)
    private $Contact;  //Contactモデル

    public function __construct()
    {
        //リクエストパラメータの取得
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
        //モデルオブジェクトの作成
        $this->Contact = new Contact();
        //別モデルと連携
        $dbh = $this->Contact->get_db_handler();
    }

    //エスケープ処理
    public function escape($str)
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }


    public function index()
    {
        $page = 0;
        if (isset($this->request['get']['page'])) {
            $page = $this->request['get']['page'];
        }

        $contacts = $this->Contact->findAll($page);
        $contacts_count = $this->Contact->countAll();
        $params = ['contacts' => $contacts, 'pages' => $contacts_count / 20, 'page' => $page];
        return $params;
    }

    public function create($name, $kana, $tel, $email, $body)
    {
        $this->Contact->create($name, $kana, $tel, $email, $body);
    }

    public function edit($id)
    {
        return $this->Contact->findId($id);
    }

    public function update($id, $name, $kana, $tel, $email, $body)
    {
        $this->Contact->update($id, $name, $kana, $tel, $email, $body);
    }

    public function destroy($id)
    {
        $this->Contact->delete($id);
    }

    public function validate($name, $kana, $tel, $email, $body)
    {
        $errors = [];
        if (empty($name)) {
            $errors['name'] = '氏名を入力してください。';
        } elseif (mb_strlen($name) > 10) {
            $errors['name'] = '10文字以内で入力してください。';
        }
        if (empty($kana)) {
            $errors['kana'] = 'フリガナを入力してください。';
        } elseif (mb_strlen($kana) > 10) {
            $errors['kana'] = '10文字以内で入力してください。';
        }
        if (preg_match("/^0[0-9]{9,10}\z/", $tel) === 0) {
            $errors['tel'] = '正しい電話番号を入力してください。';
        }
        if (empty($email)) {
            $errors['email'] = 'メールアドレスを入力してください。';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = '正しいEメールアドレスを入力してください。';
        }
        if (empty($body)) {
            $errors['body'] = 'お問い合わせ内容を入力してください。';
        }
        return $errors;
    }

}

?>
