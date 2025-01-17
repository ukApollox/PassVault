<?php
require "templates/header.php";
?>

<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half">
                <div class="has-text-centered">
                    <h2 class="title is-4 mt-4 mb-4 is-half">Add Passwords</h2>
                </div>
                <form action="#" method="POST" class="box">
                    <div class="field">
                        <label for="url_or_software_name" class="label">URL or Software Name</label>
                        <div class="control">
                            <input id="url_or_software_name" name="url_or_software_name" type="text" class="input" autocomplete="username" required>
                        </div>
                    </div>
                    <div class="field">
                        <label for="username" class="label">Username</label>
                        <div class="control">
                            <input id="username" name="username" type="text" class="input" autocomplete="username" required>
                        </div>
                    </div>

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
                    </div>

                    <div class="field is-grouped is-grouped-right">
                        <p class="control">
                            <button type="button" class="button is-light">Cancel</button>
                        </p>
                        <p class="control">
                            <button type="submit" class="button is-primary">Save</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
