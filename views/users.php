<?php
/* @var $users */

use app\Services\MessageService;

include_once __DIR__ . "/includes/header.php";
?>
<body>
<div class="wrapper">
    <section class="users">
        <header>
            <?php foreach ($users as $user): ?>
                <?php if ($user->id == $_SESSION['loggedInUser']): ?>
                    <div class="content">
                        <img src="avatars/<?= $user->img; ?>" alt="">
                        <div class="details">
                            <span><?= $user->fname . " " . $user->lname; ?></span>
                            <p><?= $user->status; ?></p>
                        </div>
                    </div>
                    <a href="/logout/<?= $_SESSION['loggedInUser']; ?>" class="logout"
                       onclick="event.preventDefault(); document.getElementById('submit-form').submit();">Logout</a>
                    <form id="submit-form" action="/logout/<?= $_SESSION['loggedInUser']; ?>" method="POST"
                          class="hidden">
                    </form>
                <?php endif; ?>
            <?php endforeach ?>
        </header>
        <div class="search">
            <span class="text">Select a user to start chat</span>
            <input type="text" placeholder="Enter name to search...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">
            <?php foreach ($users as $user): ?>
                <?php if ($user->id != $_SESSION['loggedInUser']): ?>
                    <a href="/chat/<?= $user->id ?>">
                        <div class="content">
                            <img src="avatars/<?= $user->img; ?>" alt="">
                            <div class="details">
                                <span><?= $user->fname . " " . $user->lname; ?></span>
                                <p><?php
                                    $message = new MessageService();
                                    $message->getMessage($user->id);
                                    echo $message->newMessage;
                                    ?>
                                </p>
                            </div>
                        </div>
                        <?php ($user->status == "Offline now") ? $offline = "offline" : $offline = ""; ?>
                        <div class="status-dot <?= $offline; ?>"><i class="fas fa-circle"></i></div>
                    </a>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </section>
</div>
<script src="<?php assets('javascript/users.js'); ?>"></script>
</body>
</html>
