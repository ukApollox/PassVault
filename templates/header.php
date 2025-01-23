<header class="has-background-black is-fullheight">
    <nav class="navbar is-black" role="navigation m-6" aria-label="main navigation">
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a href="home" class="m-5" ><img src="./images/passvault.png"></a>
                <a href="security" class="navbar-item is-size-5 has-text-white"><strong>Security</strong></a>
                <a href="passwords" class="navbar-item is-size-5 has-text-white"><strong>Passwords</strong></a>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <?php
                        if (!isset($_SESSION)) {
                            session_start();
                        }

                        if (isset($_SESSION['user_id'])) { ?>
                            <a href="sign-out" class="button">Sign out</a>
                            <?php
                        }
                        else { ?>
                            <a href="sign-up" class="button">Sign up</a>
                            <a href="sign-in" class="button is-light has-text-black">Sign in</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

