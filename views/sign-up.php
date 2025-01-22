<?php
require "templates/header.php";
require "models/sign-up.php";
?>

<section class="section has-text-white has-background-black is-fullheight">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-one-third">
                <div class="box">
                    <h2 class="title is-4 has-text-centered">Create your account</h2>
                    <form method="POST" action="#">
                        <div class="field">
                            <label for="firstname" class="label">Firstname</label>
                            <div class="control">
                                <input id="firstname" name="firstname" type="text" class="input" autocomplete="given-name" required>
                            </div>
                        </div>

                        <div class="field">
                            <label for="surname" class="label">Surname</label>
                            <div class="control">
                                <input id="surname" name="surname" type="text" class="input" autocomplete="family-name" required>
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

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary is-fullwidth">Sign up</button>
                            </div>
                        </div>
                    </form>

                    <p class="has-text-centered mt-4 has-text-white">
                        Already have an account? <a href="sign-in" class="has-text-link">Sign in here!</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
