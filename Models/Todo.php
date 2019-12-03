<?php
// １　1回だけしか呼び出さないからこの書き方
// 自分以外のファイルを読み込む時に使う組み込み関数
// config/dbconnect.phpを読み込んでくださいと言っている
require_once ('config/dbconnect2.php');

// ２　class Todoを作る
// これはただのリモコンでこれだけだと動いてくれない
// 動いてもらうためには　電池（データベース　電池をリモコンに入れてくれる人（dbconnect2.php）
// 　電池を入れる場所（変数）が必要
class Todo
{
    // ３このしたのtasksはこの後に何回も登場してきて変数に入れないまま書いているともし
    // 変更したい時に全部変更するのは面倒だから$tableに入れることによってもし変更があっても１箇所変更するだけでオールオッケーってなる
    // db_managerはclass Todoを動かすのに必要な電池を入れる場所
    // つまりこの後にdb_managerの中にデータベースの情報を入れる作業をします

    private $table = 'tasks';
    private $db_manager;

    // ４　データベースを繋がるようにした
    // これが誕生した瞬間にデータベースに接続してくださいっていう命令を書いているのがconstruct
    // 上記の命令が初期値
    public function __construct()
    {
        $this->db_manager = new DbManager();
        $this->db_manager->connect();
    }

    // ７　これをかく prepare excuteが関わってくるよ
    // Todo用のデータを作成するために（レコードの中にデータを入れるために）以下を書いています
    //７　この下のメソッドはデータを追加して欲しいっていう命令
    //$nameはindex.phpに入った名前をここに入れてと言っている
    public function create($name)
    {
    // ７　名前を登録したくて名前だけはINSERTで追加できるけどそれ以外のやつは自動で登録されるからINSERTのとこにname
    // だけしか書いていない
    // １行目を実行したいから２行目がないと中に入るものがない
    // ２行目はindex.phpに入ったnameを取ってくるということ
      $stmt = $this->db_manager->dbh->prepare('INSERT INTO '.$this->table.'(name) VALUES (?)');
      $stmt->execute([$name]);
    // ５４　ここの値を使うからリターンをしている
    // ここで行なっているのは2つ
    // データの登録と、最後に追加したレコードのidを取得
    return $this->db_manager->dbh->lastInsertId();

    }

    public function all()
    {
        //１２ 登録したデータを取得しに行くためのコード　selectは検索クエリ
        // prepareとexecuteはセットだからこの２行はかく　もしどちらかを書かなくてもかく
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table);
        $stmt->execute();
        // １２　一覧が欲しい時には　->fetchAll();メソッドを使う　取ってきたデータを使いやすくしてくれている
        // 使いやすくしたものを$tasksに入れている
        $tasks = $stmt->fetchALL();
        // １２　この取得したデータを他のところへ持っていけるようにするコードがreturn
        return $tasks;
    }

    //２６　新しいメソッドをこのclassの中に追加
    //editするためのデータを取得 editがgetに変わっている？？よくわからない
    // stmtにidの情報を取得している
    // executeとgetのidは繋がっているから入る
    public function get($id)
    {
    $stmt = $this->db_manager->dbh->prepare('SELECT * FROM '.$this->table.' WHERE id = ?');
    $stmt->execute([$id]);
    // ２６　fetchは一個だけ単体で取れるfetchallは全ての情報を取得する
    // 今回だとidごとの情報を取っている
    $task = $stmt->fetch();
    // ２６　この後どこかで使うからこのreturnを使っている
    return $task;
    }
    // ３４　どんなメソッドを作れば更新できる設計図を書くのかを考える
    public function update($id)
    {
    $stmt = $this->db_manager->dbh->prepare('UPDATE'.$this->table.'SET name = ?  WHERE id = ?');
    $stmt->execute([$name, $id]);
    }

    // 42　delete.phpで使うメソッドを作る
    public function delete($id)
    {
        $stmt = $this->db_manager->dbh->prepare('DELETE FROM'.$this->table.'WHERE id= ?');
        $stmt->execute([$id]);
     // ６７ リターンを追加　削除したものの値が欲しい、後から処理をしたいから
    return $stmt->execute([$id]);
    }
}


?>