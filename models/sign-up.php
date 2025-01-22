<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'database.php';

    $db = connectToDatabase();

    $errors = [];

    $firstname = $_POST["firstname"];
    $surname = $_POST["surname"];

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt_email = $db->prepare("SELECT email FROM accounts WHERE email = :email");
    $stmt_email->execute(['email' => $email]);

    if ($stmt_email->rowCount() > 0) {
        $errors[] = "Email already exists";
    }

    if (count($errors) === 0) {
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $db->prepare("INSERT INTO accounts (firstname, surname, email, password) VALUES (:firstname, :surname, :email, :password)");
            $stmt->execute([
                "firstname" => $firstname,
                "surname" => $surname,
                "email" => $email,
                "password" => $passwordhash
            ]);

            // Get the last inserted user_id
            $user_id = $db->lastInsertId();

            header("Location: sign-in");
            exit();
        } catch (PDOException $e) {
            die("Error inserting data: " . $e->getMessage());
        }
    }
}
