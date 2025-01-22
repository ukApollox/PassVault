<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'database.php';

    $encryption_key = 'your-encryption-key-here';
    $cipher_method = 'AES-256-CBC';
    $iv_length = openssl_cipher_iv_length($cipher_method);

    $iv = openssl_random_pseudo_bytes($iv_length);

    $db = connectToDatabase();
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
        // Hash the password for secure storage
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        // Encryption
        $encrypted_url_or_software_name = openssl_encrypt($url_or_software_name, $cipher_method, $encryption_key, 0, $iv);
        $encrypted_username = openssl_encrypt($username, $cipher_method, $encryption_key, 0, $iv);
        $encrypted_email = openssl_encrypt($email, $cipher_method, $encryption_key, 0, $iv);
        $encrypted_password = openssl_encrypt($passwordhash, $cipher_method, $encryption_key, 0, $iv);

        try {
            $stmt = $db->prepare("INSERT INTO user_data (url_or_software_name, username, email, password, iv) 
                                  VALUES (:url_or_software_name, :username, :email, :password, :iv)");
            $stmt->execute([
                'url_or_software_name' => $encrypted_url_or_software_name,
                'username' => $encrypted_username,
                'email' => $encrypted_email,
                'password' => $encrypted_password,
                'iv' => base64_encode($iv),  // Store the IV (initialization vector) safely
            ]);

            $user_id = $db->lastInsertId();

            header("Location: add-password");
            exit();
        } catch (PDOException $e) {
            die("Error inserting data: " . $e->getMessage());
        }
    }
}
