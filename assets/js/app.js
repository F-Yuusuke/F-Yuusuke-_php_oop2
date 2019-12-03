// ４８　初めにブランチを切ってajaxをブランチに作る
// ４９　このapp.jsを作る
// ５１JavaScriptが動いているか確認している　できていたら画面にぽんと
// 表示される
// alert()
// ６８　idがjs-delete-btn-から始まっているものを利用するというコード
// ^が以下のコードを表している[id^="js-delete-btn-"]
$(document).on('click', '[id^="js-delete-btn-"]',
    function (e) {
// ６８　削除したいレコードのidを取得するためにここをやっている
// クリックされたら削除したい
// 文字の何番目以降の数字を利用するかを使うかというやつがsubstr
// .attrは属性を取得するjQueryのメソッド
// idも属性でclassも属性
// この　の　番目より後ろの文字を利用する
// あとで使うために代入する

// ７４ 以下はクリックされた要素のデフォルトの機能を（ページ遷移）を無効にする
e.preventDefault();

// ７３　この下にあるdeleteTaskをクリックしたら削除できるようにした
deleteTask(id);
    });

// 69　削除するための関数を作成
function deleteTask(id) {
    $.ajax({
        // ７０　ここはdelete.phpのなかに削除ができる関数が置いてあるから読み込んでいる
        url: 'delete.php?id=' + id,
        // ７１　ここの値は（GET）はこっちで勝手に変更することができる
        type: 'GET',
        // ７２　受け取るデータのタイプを指定している　jsonは配列で受け取るようにしている
        dataType: 'json'
    })

    .then(
        // 処理成功
        function () {
            // ７６　７５で書いたものをここで使っている
            deleteDOM(id)

        },
        // 処理失敗
        function () {

        }
    )

        //７５　削除する関数の作成
        // 要素を削除するための方法がremove（）
        // これを処理成功のところで使う
        function deleteDOM(id) {
            // 要素 + .remove();
            $('#js-task-' + id ).remove();
        }
}


$(function(){
// ５８　index.phpの最初の画面でADDがクリックされたら
    $(document).on('click', '#js-add-task', function (e) {
    // 以下でGETで情報を取得するのをやめさせている
    e.preventDefault();
    let task = $('#js-task')
    //　　　　　　　　 varで情報を取っていたと思っていたけどどこにもvalueがなかった
    createTask(task.val())
});

// ５９　ここではCDNのなかにある$.ajaxを呼び出してきている
// そもそもこのファイルでやろうとしていることはグーグルマップのようにページを
// 遷移しなくてもできるようになりたい
// 繊維してしまうと固まった時に何もできなくなる（真っ白になるから）
// だけどこの技術を使えば固まっても他のところを操作できる
function createTask(task) {
    $.ajax({
        url: 'create.php',//ファイル名
        type: 'POST',//レスポンスの種類
        dataType: 'json',//これを使ったらphpの配列がjQueryの配列で情報が返ってくるので扱いやすい
        data: {
            task: task//格納される場所　　　　　これはどっちに格納されるんでスカ？？？？？？
        }
    })
    .then(
        //成功した時の処理
        function (task) {
            // ６３　ここは６０で書いたものを表示させている
            // console.log(task);
            renderTask(task)
        },
        //失敗したら
        function () {
        }
    )
}

// ６０　まずはここに追加　画面に追加したtaskを表示する
function renderTask(task) {
// appendは後ろに追加　prependは前に追加
// tbodyに追加するよってこと
// JavaScriptでは``を使うと変数をなかに入れることができる
$('tbody').append(
    // ６４　日付も表示できるようにしている
    `<tr><td>${task.name}</td>
        <td>${task.due_date}</td>
        <td></td>
        <td></td>
    </tr>`
        )
    }      
});