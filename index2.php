<?php
// １３ 自分以外のファイルを読み込む時に使う組み込み関数
// config/config/dbconnect.phpを読み込んでくださいと言っている
require_once ('Models/Todo.php');

// ２０　以下をすることで１９で行った処理がこのファイルで効力を持つようになる
require_once ('function.php');

// １４　ここでclassTodoが使えるぜって感じ
   //Todoクラスのインスタンス化
   $todo = new Todo();
   //１５　DBからデータを全件取得
   $tasks = $todo->all();
   //
//    var_dump($tasks);
?>



<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<!-- ５　なんか知らんけどここをコピーした -->
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
<!-- ５５　情報はphpではなくてJavaScriptで送るのでclassの後ろのものを消す -->
        <form class="form-row justify-content-center" >
            <div class="col-10 col-md-6 py-2">
            <!-- ５６　inputに操作しやすいようにidをつける -->
                <input type="text" class="form-control" placeholder="ADD TODO" name="task" id="js-task">
            </div>
            <div class="py-2 col-md-3 col-10">
            <!-- ５７ 操作しやすいようにbuttonもid追加-->
                <button type="submit" class="col-12 btn btn-primary" id="js-add-task">ADD</button>
            </div>
        </form>
</section>
  <table class="table table-hover">
      <thead>
        <tr class="bg-primary text-light">
            <th class=>TODO</th>
            <th>DUE DATE</th>
            <th></th>
            <th></th>
        </tr>
      </thead>
      <tbody>
      <!-- １６　tasksにはデータベースの情報が全て入っている（index.php１４行目）のでその情報を1個ずつ取り出したいから
      foreachをしている -->
      <?php foreach($tasks as $task):?>

        <!--ここ以下後ほど繰り返し処理する-->
        <!-- ６５　１２月３日 　行のことをそれぞれ識別できるようにidをつけてあげている
        idがつくことによって操作がしやすくなる-->
        <tr id="js-task-<?php echo h($task['id']); ?>">
        <!-- １７　タスクに入っているname（名前）due-dateと（日づけ）を1個ずつ出力しようとしている
        これをすると名前と日付を取得できるので一覧の表示ができるようになる -->
            <td><?php echo $task['name']; ?></td>
            <td><?php echo $task['due_date']; ?></td>
            <td>
            <!-- ２３　EDITをクリックするとedit.phpファイルにリンクすることができるようにする
            aタグを使うとGETが使える -->
            <!-- href以降のところをかくとクリックしたidをそれぞれ取得することができる -->
        <!-- ６６　これも画面遷移をせずに情報が反映されるようにしている
        もともと書いてあったphpのやつを削除して以下のように変更-->
            <a class="text-danger" id="js-delete-btn-<?php echo h($task['id']) ?>" href="">DELETE</a>
            </td>
        </tr>
        <!--/ ここ以上後ほど繰り返し処理する-->
        <!-- １６　 -->
        <?php endforeach;?>
      </tbody>
  </table>
</section>
    </section>       
</main>
<!-- ５２　ここでjQueryを読み込む　注意点はJavascriptより先にjQueryを読み込むこと-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- ５０ このファイルでapp.jsが使えるようにするために以下の処理をしている-->
<script src="assets/js/app.js"></script>
</body>
</html>