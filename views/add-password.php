<?php
require "templates/header.php";
require "models/add-password.php";
?>

<section class="section has-background-black is-fullheight">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-one-third">
                <div class="box">
                    <h2 class="title is-4 has-text-centered">Add Passwords</h2>
                    <form method="POST" action="add-password">
                        <div class="field">
                            <label for="url_or_software_name" class="label">URL or Software Name</label>
                            <div class="control">
                                <input id="url_or_software_name" name="url_or_software_name" type="text" class="input" autocomplete="username" required>
                            </div>
                        </div>

                        <div class="field">
                            <label for="username" class="label">Username</label>
                            <div class="control">
                                <input id="username" name="username" type="text" class="input" autocomplete="username">
                            </div>
                        </div>

                        <div class="field">
                            <label for="email" class="label">Email address</label>
                            <div class="control">
                                <input id="email" name="email" type="email" class="input" autocomplete="email">
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
                                <a href="passwords" class="button">Cancel</a>
                            </p>
                            <p class="control">
                                <button type="submit" class="button is-light">Save</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>