<?php
require_once 'Model.php';
class Tweet extends Model
{

    public function validate($data) {
        
    }

    public function get()
    {
        $sql = "SELECT 
                    tweets.id,
                    tweets.user_id,
                    tweets.message,
                    tweets.created_at,
                    users.name AS user_name
                FROM tweets 
                JOIN users ON tweets.user_id = users.id
                ORDER BY tweets.created_at DESC 
                LIMIT 20;";
        $values = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $this->values = $values;
        return $values;
    }

    public function insert($data)
    {
        $sql = "INSERT INTO tweets (user_id, message)
                VALUES (:user_id, :message)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }
}
