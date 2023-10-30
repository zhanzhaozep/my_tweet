<div class="tweet d-flex">
    <!-- profile image -->
    <div class="profile-image">
        <img src="images/me.png">
    </div>
    <!-- tweet body -->
    <div class="tweet-body">
        <!-- user info -->
        <div class="tweet-user">
            <span class="fw-bold">@<?= $value['user_name'] ?></span>
            <span class="ms-1 text-secondary"><?= date('Y/m/d H:i', strtotime($value['created_at'])) ?></span>
        </div>

        <!-- post -->
        <div class="tweet-text mt-2 mb-2">
            <?= nl2br($value['message']) ?>
        </div>

        <!-- tweet nav -->
        <?php include('tweet_nav.php') ?>
    </div>
</div>