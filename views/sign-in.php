<?php
require "templates/header.php";
require "models/sign-in.php";

// Start session
session_start();

$model = new SignInModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $inputEmail = trim($_POST['email']);
        $inputPassword = trim($_POST['password']);

        // Validate user credentials
        $user = $model->validateUser($inputEmail, $inputPassword);
        if ($user) {
            // Start the session and set session variables only after validation
            $_SESSION['email'] = $user['email'];

            // Redirect to the home route
            header('Location: home');
            exit();
        } else {
            echo "<p class='has-text-danger'>No users found with the given email and password.</p>";
        }
    } else {
        echo "<p class='has-text-danger'>Please fill in both email and password.</p>";
    }
}
?>





<section class="section has-background-black is-fullheight">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-one-third">
                <div class="box has-shadow-small">
                    <h2 class="title is-4 has-text-centered">Sign in to your account</h2>
                    <form method="POST" action="" class="has-text-white">
                        <div class="field">
                            <label for="email" class="label">Email address</label>
                            <div class="control">
                                <input id="email" name="email" type="email" class="input" autocomplete="email" required>
                            </div>
                        </div>

                        <div class="field">
                            <label for="password" class="label">Password</label>
                            <div class="control">
                                <input id="password" name="password" type="password" class="input" autocomplete="current-password" required>
                            </div>
                            <p class="help is-right">
                                <a href="#" class="is-size-7">Forgot password?</a>
                            </p>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-light is-fullwidth">Sign in</button>
                            </div>
                        </div>
                    </form>

                    <p class="has-text-centered mt-4 has-text-white">
                        Don't have an account yet? <a href="sign-up" class="has-text-link">Sign up now, it's free!</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>