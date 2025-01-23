<?php
require "templates/header.php";?>

<section class="section has-background-black is-fullheight">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-two-thirds">
                <div class="box has-shadow-none">
                    <a href="add-password" class="button is-light has-text-black is-fullwidth"><strong>Add Account Details</strong></a>
                </div>

                <!-- Display account details -->
                <div class="box">
                    <h2 class="title is-4 has-text-white">Stored Account Details</h2>
                    <?php if (!empty($accounts)): ?>
                        <table class="table is-fullwidth has-text-white">
                            <thead>
                            <tr>
                                <th>URL/Software Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Password</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($accounts as $account): ?>
                                <tr>
                                    <td><?= htmlspecialchars($account['url_or_software_name']); ?></td>
                                    <td><?= htmlspecialchars($account['username']); ?></td>
                                    <td><?= htmlspecialchars($account['email']); ?></td>
                                    <td><?= htmlspecialchars($account['password']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="has-text-white">No account details found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

