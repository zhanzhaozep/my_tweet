<?php
require_once('../app.php');

// POSTリクエスト以外は処理しない
// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     exit('can not get access');
// }

// ログインユーザチェック
$auth_user = $_SESSION['auth_user'];
if (empty($auth_user)) {
    //ユーザがいなかったらログイン画面にリダイレクト
    header('Location: login/');
    exit;
}

//IDを取得
$id = $_GET['id'];

//Tweet IDから1件取得
$tweet = new Tweet();
$delete_tweet = $tweet->fetch($id);

//自分の投稿だったら削除
if ($auth_user['id'] == $delete_tweet['user_id']) {
    //TweetのIDで投稿を削除する
    $tweet->delete($id);
}

//Tweet画面（トップページ）にリダイレクト
header('Location: ../');
exit;