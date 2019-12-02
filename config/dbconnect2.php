<?php
// ここの中はコピペで使い回せばいいですよ　その代わりデータベースの名前とかは変えるのを忘れないようにしてください
// データベースとファイルが繋がってやりとりできるための能力を持っている
class DbManager
{
    public $dbh;
    public function connect()
    {
        //DBに接続
        $host = 'localhost';
        $dbname = 'php_oop2';
        $charset = 'utf8mb4';
        $user = 'root';
        $password = '';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        try {
            $this->dbh = new PDO($dsn, $user, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
}
?>