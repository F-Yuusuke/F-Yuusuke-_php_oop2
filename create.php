<?php
// ７.5　他のファイルを呼び出すための組み込み関数　一回しか実行されない
require_once('Models/Todo.php');

// ８　index.phpのinput要素に入力された言葉をここに受け取るようにしている
$task = $_POST['task'];

// ９　ここでclassTodoが使えるぜって感じ
$todo = new Todo();

// １０　classTodoのcreateっていうメソッドを実行
$todo->create($task);

// １１　登録した後にトップのページに戻るためだけに以下を書いた
header('Location: index.php');





?>

