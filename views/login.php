<?php

if (isset($_SESSION['loggedInUser'])) {
    header("location: /");
}
?>

<?php include_once "includes/header.php"; ?>
    <body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime Chat App</header>
            <form action="/login" method="POST" enctype="multipart/form-data">
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email">
                    <p class="error-text">
                        <?php error('email'); ?>
                    </p>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password">
                    <i class="fas fa-eye"></i>
                </div>
                <p class="error-text">
                    <?php error('password'); ?>
                </p>
                <div class="field button">
                    <input type="submit" name="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Not yet signed up? <a href="/register">Signup now</a></div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <!--<script src="javascript/login.js"></script>-->

    </body>
    </html>
<?php session_destroy(); ?>