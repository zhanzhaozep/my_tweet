<?php
//初期設定読み込み
require_once('app.php');

// ログインユーザチェック
$auth_user = $_SESSION['auth_user'];
if (empty($auth_user)) {
    //ユーザがいなかったらログイン画面にリダイレクト
    header('Location: login/');
    exit;
}

//Tweet投稿一覧を取得
$tweet = new Tweet();
$tweets = $tweet->get();
?>

<!DOCTYPE html>
<html lang="en">

<!-- コンポーネント -->
<?php include('app/views/components/head.php') ?>

<body>

    <div class="container-fluid">
        <div class="row">
            <header class="col-md-3">

                <?php include('app/views/components/tweet_menu.php') ?>

                <div class="tweet-user">
                    <span class="fw-bold">@<?= $auth_user['name'] ?></span>
                </div>
            </header>

            <main class="col-md-9">
                <h2>Home</h2>
                <div class="row">
                    <?php include('app/views/components/tweet_form.php') ?>
                </div>

                <div class="row">
                    <!-- Tweetの繰り返し表示 -->
                    <?php foreach ($tweets as $value) : ?>
                    <?php include('app/views/components/tweet.php') ?>
                    <?php endforeach ?>
                </div>

            </main>

        </div>
    </div>

</body>

</html>