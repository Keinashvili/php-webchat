<?php
if (isset($_SESSION['unique_id'])) {
    header("location: /");
}
?>

<?php include_once "includes/header.php"; ?>
<body>
<div class="wrapper">
    <section class="form signup">
        <header>Realtime Chat App</header>
        <form action="/register" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="error-text"></div>
            <div class="name-details">
                <div class="field input">
                    <label>First Name</label>
                    <input type="text" name="fname" placeholder="First name" >
                </div>
                <div class="field input">
                    <label>Last Name</label>
                    <input type="text" name="lname" placeholder="Last name" >
                </div>
            </div>
            <div class="field input">
                <label>Email Address</label>
                <input type="text" name="email" placeholder="Enter your email" >
            </div>
            <div class="field input">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter new password" >
                <i class="fas fa-eye"></i>
            </div>
            <div class="field image">
                <label>Select Image</label>
                <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" >
            </div>
            <div class="field button">
                <input type="submit" name="submit" value="Continue to Chat">
            </div>
        </form>
        <div class="link">Already signed up? <a href="/login">Login now</a></div>
    </section>
</div>

<script src="javascript/pass-show-hide.js"></script>
<script src="javascript/signup.js"></script>

</body>
</html>
