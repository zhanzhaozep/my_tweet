<?php
require_once('../app.php');

// POSTリクエスト以外は処理しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('can not get access');
}
// POSTリクエストされたデータを取得
// サニタイズ（エスケープ処理）
$post = check($_POST);

// POSTデータをセッションに保存
$_SESSION['regist'] = $_POST;

// バリデーション
$errors = validate($post);

// エラーだったら、入力画面にリダイレクト(URL転送)
if ($errors) {
    // エラーをセッションに登録
    $_SESSION['errors'] = $errors;
    header('Location: input.php');
    exit;
}

//デバッグ関数で確認
// var_dump($post);

function validate($data)
{
    $errors = [];
    if (empty($data['name'])) {
        $errors['name'] = "Nameが入力されていません";
    }
    if (empty($data['email'])) {
        $errors['email'] = "Emailが入力されていません";
    } else {
        // Emailが既に登録されているか？チェック
        $user = new User();
        if ($user->findByEmail($data['email'])) {
            $errors['email'] = "Emailは既に登録されています。";
        }
    }
    if (empty($data['password'])) {
        $errors['password'] = "Passwordが入力されていません";
    }

    return $errors;
}

/**
 * サニタイズ（エスケープ処理）
 */
function check($posts)
{
    if (empty($posts)) return;
    foreach ($posts as $column => $post) {
        $posts[$column] = htmlspecialchars($post, ENT_QUOTES, 'UTF-8');
    }
    return $posts;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('../app/views/components/head.php') ?>

<body>
    <main id="id" class="d-flex justify-content-center">
        <div class="w-50 mt-3 p-5 bg-light">
            <h2 class="h2 mb-3 fw-normal text-center">Regist</h2>
            <p>この内容で登録しますか？</p>
            <form action="add.php" method="post">
                <div class="mb-2">
                    <label for="" class="form-label">Name</label>
                    <!-- PHPの変数を表示 -->
                    <?= $post['name'] ?>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Email</label>
                    <?= $post['email'] ?>
                </div>
                <div>
                    <button class="w-100 mb-2 btn btn-primary">Regist</button>
                    <a href="input.php" class="w-100 btn btn-outline-primary">Back</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>