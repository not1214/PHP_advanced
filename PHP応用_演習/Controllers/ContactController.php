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

}

?>
