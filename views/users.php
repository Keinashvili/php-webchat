<?php
if (!isset($_SESSION['unique_id'])) {
    header("location: /login");
}
?>
<?php include_once __DIR__."/includes/header.php"; ?>
<body>
<div class="wrapper">
    <section class="users">
        <header>
            <div class="content">
                <img src="avatars/<?php echo $users['img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $users['fname'] . " " . $users['lname'] ?></span>
                    <p><?php echo $users['status']; ?></p>
                </div>
            </div>
            <a href="/logout/<?php echo $users['unique_id']; ?>" class="logout" onclick="event.preventDefault(); document.getElementById('submit-form').submit();">Logout</a>

<!--            <a href="php/logout.php?logout_id=--><?php //echo $users['unique_id']; ?><!--" class="logout">Logout</a>-->

            <form id="submit-form" action="/logout/<?php echo $users['unique_id']; ?>" method="POST">
            </form>


        </header>
        <div class="search">
            <span class="text">Select an user to start chat</span>
            <input type="text" placeholder="Enter name to search...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">

        </div>
    </section>
</div>

<script src="javascript/users.js"></script>

</body>
</html>
