// ４８　初めにブランチを切ってajaxをブランチに作る
// ４９　このapp.jsを作る
// ５１JavaScriptが動いているか確認している　できていたら画面にぽんと
// 表示される
// alert()
// ５３　　　　　　先にコードを読んでもらう処理はどこに行ったんですか？？？？？
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