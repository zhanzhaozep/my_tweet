<nav class="tweet-nav">
    <ul class="d-flex">
        <li>
            <a href="#">
                <img src="svg/bubble.svg" alt="">
            </a>
        </li>
        <li>
            <a href="#">
                <img src="svg/heart.svg" alt="">
            </a>
        </li>
        <li>
            <a href="#">
                <img src="svg/loop.svg" alt="">
            </a>
        </li>
        <li>
            <?php if ($auth_user['id'] == $value['user_id']) : ?>
                <a href="tweet/delete.php?id=<?= $value['id'] ?>">
                    <img src="svg/trash.svg" alt="">
                </a>
            <?php endif ?>
        </li>
    </ul>
</nav>