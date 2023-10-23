<?php
require_once("Model.php");
class User extends Model
{
    public static function authUser()
    {
        if (!empty($_SESSION['auth_user'])) {
            return $_SESSION['auth_user'];
        }
    }

    public static function userIcon($id)
    {
        $iconFile = "{$id}.png";
        $iconFilePath = BASE_DIR . "/images/user_icon/{$iconFile}";
        if (file_exists($iconFilePath)) {
            return $iconFile;
        } else {
            return "me.png";
        }
    }

    public function auth($email, $password)
    {
        if ($user = $this->findByEmail($email)) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function insert($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password)
                VALUES (:name, :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    function validateRegist($data)
    {
        $errors = [];
        if (empty($data['name'])) $errors['name'] = '氏名を入力してください。';
        if (empty($data['email'])) {
            $errors['email'] = 'Emailを入力してください。';
        } else if ($this->findByEmail($data['email'])) {
            $errors['email'] = 'Emailが登録済みです';
        }
        if (empty($data['password'])) {
            $errors['password'] = 'パスワードを入力してください。';
        } else if (strlen($data['password']) < 6 || strlen($data['password']) > 20) {
            $errors['password'] = 'パスワードは6文字以上、20文字以内で入力してください';
        }
        return $errors;
    }
}