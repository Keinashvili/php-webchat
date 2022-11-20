<?php
include_once "includes/header.php"; ?>
    <body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime Chat App</header>
            <form action="/register" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="First name">
                        <p class="error-text">
                            <?php error('fname'); ?>
                        </p>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="Last name">
                        <p class="error-text">
                            <?php error('lname'); ?>
                        </p>
                    </div>
                </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email">
                    <p class="error-text">
                        <?php error('email'); ?>
                    </p>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter new password">
                    <i class="fas fa-eye"></i>
                </div>
                <p class="error-text">
                    <?php error('password'); ?>
                </p>
                <div class="field input">
                    <label>Repeat Password</label>
                    <input type="password" name="password_again" placeholder="Enter new password">
                    <i class="fas fa-eye"></i>
                </div>
                <p class="error-text">
                    <?php error('password_again'); ?>
                </p>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Already signed up? <a href="/login">Login now</a></div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    </body>
    </html>
<?php session_destroy();