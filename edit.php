<!-- ２４　phpをかけるようにする -->
<?php
// <!-- ２５　var_dumpでちゃんとデータが取れているか確認する -->
// ここで変数が未設定だよと言われます　エラー
// $id = $_GET['id'];
// var_dump($id);

// ２９　このページにも入力ホームがあるのでエスケープ処理を実行するために
// function.phpを読み込んであげる
// 基本的な情報　先に読み込まないといけないからこの位置に設置している
require_once ('function.php');

// <!-- ２７　Models/Todo.phpのファイルを読み込んでくださいの呪文 -->
require_once('Models/Todo.php');
// ２６.５　ここでまたclassTodoが使えるってなっている
$todo = new Todo();
?>



<!-- ２１　edit.phpを作る -->
<!-- ２２　なんか知らんけど下のやつ（１１２７・１４：０７）をコピペした -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO APP</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="px-5 bg-primary">
        <nav class="navbar navbar-dark">
            <a href="index.php" class="navbar-brand">TODO APP</a>
            <div class="justify-content-end">
                <span class="text-light">
                    SeedKun
                </span>
            </div>
        </nav>
    </header>
    <main class="container py-5">
        <section>
            <form class="form-row" action="update.php" method="POST">
                <div class="col-12 col-md-9 py-2">
                <!-- ２８　inputの中にvalueを書き足した nameと合致しているものの情報を取っている-->
                <!-- ３０　 エスケープ処理を実行したい箇所をh()で囲むとそこにエスケープ処理をを実行してくれる-->
                <input type="text" name="task" class="form-control" placeholder="ADD TODO" value="<?php echo h($task['name'])?>">
                <!-- ３１　これを書くことによってみんなには見えないけど情報が送れるようになるこの次にどこに送るのかを書いていく -->
                <!-- ３２　valueにidが格納されるようにする 元の情報がゲットできたから次はこの情報を更新できるようにことが必要-->
                <input type="hidden" name="id" value="<?php echo h($task['id']);?>">
                </div>
                <div class="py-2 col-md-3 col-12">
                    <button type="submit" class="col-12 btn btn-primary btn-block">UPDATE</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
