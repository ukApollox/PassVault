<?php
require_once 'database.php';


if (!isset($_SESSION)) {
    session_start();
}

class SignInModel {

    public function validateUser($email, $password) {
        $db = connectToDatabase();
        if (!$db) {
            die('Database connection failed.');
        }

        // Prepare the query
        $stmt = $db->prepare('SELECT * FROM accounts WHERE email = :email');
        if (!$stmt->execute([':email' => $email])) {
            die('Query failed: ' . print_r($stmt->errorInfo(), true));
        }
        // Fetch user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            die('No user found with the provided email.');
        }

        // Debugging output
        print_r($user);

        // Password verification
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            return $user;
        }

        echo 'Password verification failed.';
        return false;
    }
}