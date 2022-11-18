<?php
if (!isset($_SESSION['unique_id'])) {
    header("location: /login");
}

/* @var $user */

use app\Services\MessageService;

?>
<?php include_once "includes/header.php"; ?>
<body>
<div class="wrapper">
    <section class="chat-area">
        <header>
            <a href="/" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            <img src="<?php
            $img = $user['img'];
            assets("avatars/$img"); ?>" alt="">
            <div class="details">
                <span><?= $user['fname'] . " " . $user['lname']; ?></span>
                <p><?= $user['status']; ?></p>
            </div>
        </header>
        <div class="chat-box">
            <?php (new MessageService())->getChat() ?>
        </div>

        <form action="#" class="typing-area">
            <input type="text" class="incoming_id" name="incoming_id" value="<?= $_SESSION['id']; ?>" hidden>
            <input type="text" name="message" class="input-field" placeholder="Type a message here..."
                   autocomplete="off">
            <button><i class="fab fa-telegram-plane"></i></button>
        </form>
    </section>
</div>

<script src="<?php assets('javascript/chat.js'); ?>"></script>

</body>
</html>
