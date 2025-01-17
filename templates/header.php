<header>
    <nav class="navbar is-black" role="navigation m-6" aria-label="main navigation">
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a href="security" class="navbar-item is-size-5 has-text-white">Security</a>
                <a href="help" class="navbar-item is-size-5 has-text-white">Help</a>
                <a href="passwords" class="navbar-item is-size-5 has-text-white">Passwords</a>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <?php
                        if (isset($_SESSION['users_id'])) { ?>
                            <a href="sign-out" class="button is-primary"><strong>Sign out</strong></a>
                            <?php
                        }
                        else{ ?>
                            <a href="sign-up" class="button is-primary"><strong>Sign up</strong></a>
                            <a href="sign-in" class="button is-light">Sign in</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

