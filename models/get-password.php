<?php
// Assuming $db is your database connection
$stmt = $db->prepare("SELECT url_or_software_name, username, email, password, iv FROM user_data WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);

$row = $stmt->fetch();

// Decrypt data
$iv = base64_decode($row['iv']);  // Decode the stored IV
$decrypted_url_or_software_name = openssl_decrypt($row['url_or_software_name'], $cipher_method, $encryption_key, 0, $iv);
$decrypted_username = openssl_decrypt($row['username'], $cipher_method, $encryption_key, 0, $iv);
$decrypted_email = openssl_decrypt($row['email'], $cipher_method, $encryption_key, 0, $iv);
$decrypted_password = openssl_decrypt($row['password'], $cipher_method, $encryption_key, 0, $iv);
