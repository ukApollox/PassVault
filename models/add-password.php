<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'database.php';
    $db = connectToDatabase();

    if (!isset($_SESSION['user_id'])) {
        die("User is not logged in.");
    }

    $user_id = $_SESSION['user_id'];

    $stmt_password = $db->prepare("SELECT password FROM accounts WHERE user_id = :user_id");
    $stmt_password->execute(['user_id' => $user_id]);

    $password_row = $stmt_password->fetch(PDO::FETCH_ASSOC);

    if ($password_row) {
        $password_hash = $password_row['password'];

        // Combine user_id and password
        $combined = $user_id . $password_hash;

        // Generate encryption key using SHA-256
        $encryption_key = hash('sha256', $combined);

        $cipher_method = 'AES-256-CBC';
        $iv_length = openssl_cipher_iv_length($cipher_method);
        $iv = openssl_random_pseudo_bytes($iv_length);

        $errors = [];
        $url_or_software_name = $_POST["url_or_software_name"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $stmt_email = $db->prepare("SELECT email FROM accounts WHERE email = :email");
        $stmt_email->execute(['email' => $email]);

        if ($stmt_email->rowCount() > 0) {
            $errors[] = "Email already exists";
        }

        // Proceed if no errors
        if (count($errors) === 0) {
            $passwordhash = password_hash($password, PASSWORD_DEFAULT);

            // Encryption
            $encrypted_url_or_software_name = openssl_encrypt($url_or_software_name, $cipher_method, $encryption_key, 0, $iv);
            $encrypted_username = openssl_encrypt($username, $cipher_method, $encryption_key, 0, $iv);
            $encrypted_email = openssl_encrypt($email, $cipher_method, $encryption_key, 0, $iv);
            $encrypted_password = openssl_encrypt($passwordhash, $cipher_method, $encryption_key, 0, $iv);

            try {
                $stmt = $db->prepare("INSERT INTO user_data (url_or_software_name, user_id, username, email, password, iv) 
                                      VALUES (:url_or_software_name, :user_id, :username, :email, :password, :iv)");
                $stmt->execute([
                    'url_or_software_name' => $encrypted_url_or_software_name,
                    'user_id' => $user_id,
                    'username' => $encrypted_username,
                    'email' => $encrypted_email,
                    'password' => $encrypted_password,
                    'iv' => base64_encode($iv),
                ]);

                header("Location: passwords");
                exit();
            } catch (PDOException $e) {
                die("Error inserting data: " . $e->getMessage());
            }
        }
    } else {
        die("User password not found.");
    }
}
