<!-- Content -->
<div class="detail-content">
    <div class="center-template">
        <div class="profile-left">
            <h2><?= $user->firstname ?> <?= $user->lastname ?>'s Profile</h2>
            <br>
            <h2>Username: <?= $user->username ?></h2>
            <h2>Email: <?= $user->email ?></h2>
            <h2>Gender: <?= $user->gender ?></h2>

            <h2>User type: <?= $user->role == 0 ? 'Regular' : 'Admin' ?></h2>

            <br>
            <h2>Registered: <?= $user->date_registered ?></h2>

            <?php if ($_SESSION['loggedInUserID'] == $user->id) : ?>

                <form id="changePassword" action="<?= BASE_URL ?>/changePassword/process" method="post">
                    <input class="text" type="password" name="password" placeholder="New Password" required="">
                    <input class="button" type="submit" value="Change Password">
                </form>
            <?php endif; ?>
            <?php if (isset($_SESSION['msg'])) : ?>
                <div id="msg">
                    <?= $_SESSION['msg'] ?>
                </div>
                <?php unset($_SESSION['msg']); ?>
            <?php endif; ?>

        </div>
        <div class="profile-right">
            <?php if (count($events) > 0) : ?>
                <ul>
                    <?php foreach ($events as $event) : ?>
                        <li><?= formatEvent($event) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>No recent activity yet.</p>
            <?php endif; ?>
        </div>

    </div>

</div>
<!-- Content -->