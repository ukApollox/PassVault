<?php
session_start();
require "models/database.php";
require "templates/header.php";

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

$user_id = $_SESSION['user_id'];
$db = connectToDatabase();

// Fetch user password for encryption key
$stmt_password = $db->prepare("SELECT password FROM accounts WHERE user_id = :user_id");
$stmt_password->execute(['user_id' => $user_id]);

$password_row = $stmt_password->fetch(PDO::FETCH_ASSOC);

if ($password_row) {
    $password_hash = $password_row['password'];
    $combined = $user_id . $password_hash;
    $encryption_key = hash('sha256', $combined);

    // Fetch encrypted data for the logged-in user
    $stmt = $db->prepare("SELECT url_or_software_name, username, email, password, iv FROM user_data WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <section class="section has-background-black is-fullheight">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-two-thirds">
                    <div class="box has-shadow-none">
                        <a href="add-password" class="button is-light is-fullwidth"><strong>Add Account Details</strong></a>
                        <?php if (!empty($user_data)): ?>
                            <table class="table is-fullwidth is-bordered">
                                <thead>
                                <tr>
                                    <th>URL or Software Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($user_data as $row):
                                    $iv = base64_decode($row['iv']); // Decode the IV
                                    $decrypted_url_or_software_name = openssl_decrypt($row['url_or_software_name'], 'AES-256-CBC', $encryption_key, 0, $iv);
                                    $decrypted_username = openssl_decrypt($row['username'], 'AES-256-CBC', $encryption_key, 0, $iv);
                                    $decrypted_email = openssl_decrypt($row['email'], 'AES-256-CBC', $encryption_key, 0, $iv);
                                    $decrypted_password = openssl_decrypt($row['password'], 'AES-256-CBC', $encryption_key, 0, $iv);
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($decrypted_url_or_software_name) ?></td>
                                        <td><?= htmlspecialchars($decrypted_username) ?></td>
                                        <td><?= htmlspecialchars($decrypted_email) ?></td>
                                        <td><?= htmlspecialchars($decrypted_password) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="has-text-white">No saved passwords found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
} else {
    die("User password not found.");
}
?>
