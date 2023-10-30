<?php
require_once('../app.php');

// POSTリクエスト以外は処理しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('can not get access');
}

// ログインユーザチェック
$auth_user = $_SESSION['auth_user'];
if (empty($auth_user)) {
    //ユーザがいなかったらログイン画面にリダイレクト
    header('Location: login/');
    exit;
}

//TODO: サニタイズ
//POSTデータを取得
$post = $_POST;
//ログインユーザIDを投稿データに追加
$post['user_id'] = $auth_user['id'];

//投稿処理
$tweet = new Tweet();
$tweet->insert($post);

//Tweet画面（トップページ）にリダイレクト
header('Location: ../');
exit;