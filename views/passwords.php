<?php
session_start();
require "models/database.php";
require "models/passwords.php";
require "templates/header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in");
    exit();
}
$user_id = $_SESSION['user_id'];
$db = connectToDatabase();
$model = new PasswordModel($db);

$password_hash = $model->getUserPasswordHash($user_id);
if ($password_hash) {
    $combined = $user_id . $password_hash;
    $encryption_key = hash('sha256', $combined);

    $user_data = $model->getUserData($user_id);
    ?>
    <section class="section has-background-black is-fullheight">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-two-thirds">
                    <div class="box has-shadow-none">
                        <a href="add-password" class="button is-light is-fullwidth mb-5"><strong>Add Account Details</strong></a>
                        <?php if (!empty($user_data)): ?>
                            <table class="table is-fullwidth is-striped is-hoverable">
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
                                foreach ($user_data as $index => $row):
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
                                        <td>
                                            <div class="field has-addons">
                                                <div class="control">
                                                    <input type="password" id="password-<?= $index ?>" class="input is-small password-field" value="<?= htmlspecialchars($decrypted_password) ?>" readonly>
                                                </div>
                                                <div class="control">
                                                    <button class="button is-small is-light toggle-password" data-target="password-<?= $index ?>" aria-label="Toggle password visibility">
                                                        <span class="icon">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
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
    <script>
        // JavaScript for toggling password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                const target = document.getElementById(this.dataset.target);
                const icon = this.querySelector('i');
                if (target.type === 'password') {
                    target.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    target.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });
    </script>
    <?php
} else {
    die("User password not found.");
}
?>
