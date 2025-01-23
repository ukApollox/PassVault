<?php
require "templates/header.php";
?>

    <section class="section has-background-black is-fullheight">
        <div class="container has-text-centered">
            <!-- Welcome Section -->
            <div class="content has-text-white">
                <h1 class="title is-1 has-text-white">Welcome to PassVault</h1>
                <p class="subtitle is-4 has-text-grey-light">
                    Securely store, manage, and retrieve your passwords with ease.
                </p>
            </div>

            <!-- Call-to-Action Buttons -->
            <div class="buttons is-centered mt-6">
                <a href="add-password" class="button is-primary is-medium">
                <span class="icon">
                    <i class="fas fa-plus"></i>
                </span>
                    <span>Add New Password</span>
                </a>
                <a href="passwords" class="button is-light is-medium">
                <span class="icon">
                    <i class="fas fa-list"></i>
                </span>
                    <span>View Saved Passwords</span>
                </a>
            </div>

            <!-- Features Section -->
            <div class="box mt-6 has-background-dark">
                <div class="columns">
                    <div class="column has-text-centered">
                    <span class="icon is-large has-text-primary">
                        <i class="fas fa-lock fa-2x"></i>
                    </span>
                        <h3 class="title is-5 has-text-white">End-to-End Encryption</h3>
                        <p class="has-text-grey-light">
                            Your data is encrypted and secure at all times.
                        </p>
                    </div>
                    <div class="column has-text-centered">
                    <span class="icon is-large has-text-primary">
                        <i class="fas fa-cloud fa-2x"></i>
                    </span>
                        <h3 class="title is-5 has-text-white">Cloud Sync</h3>
                        <p class="has-text-grey-light">
                            Access your passwords anywhere, anytime.
                        </p>
                    </div>
                    <div class="column has-text-centered">
                    <span class="icon is-large has-text-primary">
                        <i class="fas fa-shield-alt fa-2x"></i>
                    </span>
                        <h3 class="title is-5 has-text-white">Privacy First</h3>
                        <p class="has-text-grey-light">
                            We respect your privacy and never use or sell your data.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
require "templates/footer.php";
