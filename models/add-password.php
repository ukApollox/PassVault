<?php
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = [];

    $url_or_software_name = $_POST["url_or_software_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $pdo = connectToDatabase();


    $stmt_email = $pdo->prepare("SELECT email FROM accounts WHERE email = :email");
    $stmt_email->execute(['email' => $email]);

    if ($stmt_email->rowCount() > 0) {
        $errors[] = "Email already exists";
    }

    if (count($errors) === 0) {
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $pdo->beginTransaction();

            // Insert into accounts table
            $stmt = $pdo->prepare("INSERT INTO `accounts` (firstname, surname, email, password) VALUES (:firstname, :surname, :email, :password)");
            $stmt->execute([
                "firstname" => $url_or_software_name,
                "surname" => $username,
                "email" => $email,
                "password" => $passwordhash
            ]);

            // Get the last inserted user_id
            $user_id = $pdo->lastInsertId();

            // Insert into user_data table
            $stmt_data = $pdo->prepare("INSERT INTO `user_data` (user_id, url_or_software_name, username, email, password) VALUES (:user_id, :url_or_software_name, :username, :email, :password)");
            $stmt_data->execute([
                "user_id" => $user_id,
                "url_or_software_name" => $url_or_software_name,
                "username" => $username,
                "email" => $email,
                "password" => $passwordhash
            ]);

            $pdo->commit();

            header("Location: sign-in");
            exit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            die("Error inserting data: " . $e->getMessage());
        }
    }
}
