<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWD', 'naoto1214');
define('DB_NAME', 'casteria');
$dsn = 'mysql:dbname ='.DB_NAME.':host='.DB_HOST;

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASSWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "接続成功\n";
  // 接続成功
} catch (PDOException $e) {
    echo "接続失敗: ".$e -> getMessage()."\n";
    exit();
  // 接続失敗
}
