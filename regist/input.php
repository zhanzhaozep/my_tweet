<?php
require_once('../app.php');

if (!empty($_SESSION['regist'])) {
    $regist = $_SESSION['regist'];
}

//セッションにエラーがあれば取得
if (!empty($_SESSION['errors'])) {
    //セッションのエラー削除
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tweet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <main id="id" class="d-flex justify-content-center">
        <div class="w-50 mt-3 p-5 bg-light">
            <h2 class="h2 mb-3 fw-normal text-center">Regist</h2>
            <form action="confirm.php" method="post">
                <div class="form-floating mb-2">
                    <input type="text" name="name" value="<?= @$regist['name'] ?>" class="form-control">
                    <label for="" class="form-label">Name</label>
                    <p class="text-danger"><?= @$errors['name'] ?></p>
                </div>
                <div class="form-floating mb-2">
                    <input type="email" name="email" value="<?= @$regist['email'] ?>" class="form-control">
                    <label for="" class="form-label">Email</label>
                    <p class="text-danger"><?= @$errors['email'] ?></p>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" name="password" class="form-control">
                    <label for="" class="form-label">Password</label>
                    <p class="text-danger"><?= @$errors['password'] ?></p>
                </div>
                <div>
                    <button class="w-100 mb-2 btn btn-primary">Regist</button>
                    <a href="../login/" class="w-100 btn btn-outline-primary">Sign in</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>