<?php
require_once('./Db.php');

class Contact extends Db
{
    public function __construct($dbh = null) {
        parent::__construct($dbh);
    }

    //contactsテーブルから全データ取得（20件毎）
    public function findAll($page = 0):Array {
        try {
            //トランザクション開始
            $this->begin_transaction();
            //SQL作成
            $sql = 'SELECT * FROM contacts LIMIT 20 OFFSET '.(20 * $page);
            $sth = $this->dbh->prepare($sql);
            //実行
            $sth->execute();
            //値の格納(カラムのみ)
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "接続失敗:" . $e->getMessage() . "\n";
            //エラー時はロールバック
            $this->rollback();
        }
    }

    public function create($name, $kana, $tel, $email, $body) {
        try {
            //トランザクション開始
            $this->begin_transaction();
            //SQL作成
            $sql = 'INSERT INTO contacts (name, kana, tel, email, body) VALUES (:name, :kana, :tel, :email, :body)';
            $sth = $this->dbh->prepare($sql);
            //値のセット
            $sth->bindValue(':name', $name, PDO::PARAM_STR);
            $sth->bindValue(':kana', $kana, PDO::PARAM_STR);
            $sth->bindValue(':tel', $tel, PDO::PARAM_STR);
            $sth->bindValue(':email', $email, PDO::PARAM_STR);
            $sth->bindValue(':body', $body, PDO::PARAM_STR);
            //実行
            $sth->execute();
            //コミット
            $this->commit();
        } catch (PDOException $e) {
            echo "接続失敗:".$e->getMessage()."\n";
            //エラー時はロールバック
            $this->rollback();
        }
    }
}

?>
