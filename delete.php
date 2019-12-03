<!-- ４１　削除機能を作るためにこのファイルを作った -->
<?php
// ４３ 'Models/Todo.php'ファイルをリクワイヤーする
// なぜならclassTodoの中に使いたいメソッドがあるから
require_once ('Models/Todo.php');

// ４４　ediat.phpで入力された情報を以下で受け取れるようにしている
// ここの下がポストかゲットかっていうのはどこで決まるんですか
// それは今回の場合だとindex.phpのformタグにPOSTと書かれているからだよ
// そこにPOSTと書かれていなかったらGET送信になるよ
// POST送信にしたかったらformタグにする必要があるよ
$id = $_POST['id'];

// ４５　ここでさっきclassTodoの中に作ったdeleteメソッドを使うときがきた
$todo = new Todo();

// ４６　classTodoのupdateっていうメソッドを実行 更新したいから
// このメソッドの中には値を取得してきて新しいものに更新するっていう設計図がかかれてあるから
// 以下のコードを書くだけでそれを実行してくれる
$todo->update($id);

// ４７　登録した後にトップのページに戻るためだけに以下を書いた
// ７７　下記を削除画面遷移しないのでコメントアウト
// header('Location: index.php');

// ７８　classTodoのcreateメソッドを実行
$res = $todo->delete($id);

// ７９　１２月３日
// 上記で値を取ってきてその値を取得している
// ここでphpを抜けたい　jsに戻りたいから
echo json_encode($res);
exit();

// ここのファイルではupdate.phpやcreate.phpと同じことをしている
// 今日は４７で完

?>