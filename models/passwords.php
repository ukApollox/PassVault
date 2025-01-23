<?php
class PasswordModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserPasswordHash($userId) {
        $stmt = $this->db->prepare("SELECT password FROM accounts WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['password'] ?? null;
    }

    public function getUserData($userId) {
        $stmt = $this->db->prepare("SELECT url_or_software_name, username, email, password, iv FROM user_data WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
