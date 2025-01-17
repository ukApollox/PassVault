<?php
require "templates/header.php";
require "models/sign-up.php";
?>

<div class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half">
                <div class="has-text-centered">
                    <h2 class="title is-4 mt-4 mb-4">Create your account</h2>
                </div>

                <form action="#" method="POST" class="box">
                    <div class="field">
                        <label for="firstname" class="label">Firstname</label>
                        <div class="control">
                            <input type="text" name="firstname" id="firstname" class="input" autocomplete="given-name" required>
                        </div>
                    </div>

                    <div class="field">
                        <label for="surname" class="label">Surname</label>
                        <div class="control">
                            <input type="text" name="surname" id="surname" class="input" autocomplete="family-name" required>
                        </div>
                    </div>

                    <div class="field">
                        <label for="email" class="label">Email address</label>
                        <div class="control">
                            <input type="email" name="email" id="email" class="input" autocomplete="email" required>
                        </div>
                    </div>

                    <div class="field">
                        <label for="password" class="label">Password</label>
                        <div class="control">
                            <input type="password" name="password" id="password" class="input" autocomplete="current-password" required>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-primary is-fullwidth">Sign up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
