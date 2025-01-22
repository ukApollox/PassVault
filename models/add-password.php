<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'database.php';

    // AES Encryption/Decryption key (Should be stored securely, not hardcoded in production)
    $encryption_key = 'your-encryption-key-here';  // Store this securely (e.g., in environment variables)
    $cipher_method = 'AES-256-CBC';  // AES 256 CBC mode
    $iv_length = openssl_cipher_iv_length($cipher_method);

    // Generate a secure initialization vector
    $iv = openssl_random_pseudo_bytes($iv_length);

    $db = connectToDatabase();
    $errors = [];

    // Collect user inputs
    $url_or_software_name = $_POST["url_or_software_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email already exists in the accounts table
    $stmt_email = $db->prepare("SELECT email FROM accounts WHERE email = :email");
    $stmt_email->execute(['email' => $email]);

    if ($stmt_email->rowCount() > 0) {
        $errors[] = "Email already exists";
    }

    // Proceed if no errors
    if (count($errors) === 0) {
        // Hash the password for secure storage
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        // Encrypt all sensitive data
        $encrypted_url_or_software_name = openssl_encrypt($url_or_software_name, $cipher_method, $encryption_key, 0, $iv);
        $encrypted_username = openssl_encrypt($username, $cipher_method, $encryption_key, 0, $iv);
        $encrypted_email = openssl_encrypt($email, $cipher_method, $encryption_key, 0, $iv);
        $encrypted_password = openssl_encrypt($passwordhash, $cipher_method, $encryption_key, 0, $iv);

        try {
            // Prepare and execute the insertion into the database
            $stmt = $db->prepare("INSERT INTO user_data (url_or_software_name, username, email, password, iv) 
                VALUES (:url_or_software_name, :username, :email, :password, :iv)");
            $stmt->execute([
                'url_or_software_name' => $encrypted_url_or_software_name,
                'username' => $encrypted_username,
                'email' => $encrypted_email,
                'password' => $encrypted_password,
                'iv' => base64_encode($iv),  // Store the IV (initialization vector) safely
            ]);

            // Get the last inserted user_id
            $user_id = $db->lastInsertId();

            // Redirect or handle success
            header("Location: add-password");
            exit();
        } catch (PDOException $e) {
            die("Error inserting data: " . $e->getMessage());
        }
    }
}
