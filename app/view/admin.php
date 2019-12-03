<!-- Content -->
<div class="detail-content">
    <div class="center-template admin">
        <h2>Admin Page</h2>
        <!-- Populate all users for admin -->
        <?php foreach ($users as $us) : ?>
            <div class="recent-comments-contents">
                <div class="timestamp">
                    <p>Username: <?= $us->username ?></p>
                    <form id="updateRole" action="<?= BASE_URL ?>/admin/updaterole" method="post">
                        <input type="hidden" name="username" value="<?= $us->username ?>">
                        <select name="role">
                            <option value="0" <?= $us->role == 0 ? 'selected' : '' ?>>Regular</option>
                            <option value="1" <?= $us->role == 1 ? 'selected' : '' ?>>Admin</option>
                        </select>

                        <input class="button" type="submit" value="Change Role">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <?php foreach ($users as $us) : ?>
            <div class="recent-comments-contents">
                <div class="timestamp">
                    <p>Username: <?= $us->username ?></p>
                    <form id="updateRole" action="<?= BASE_URL ?>/admin/updaterole" method="post">
                        <input type="hidden" name="username" value="<?= $us->username ?>">
                        <select name="role">
                            <option value="0" <?= $us->role == 0 ? 'selected' : '' ?>>Regular</option>
                            <option value="1" <?= $us->role == 1 ? 'selected' : '' ?>>Admin</option>
                        </select>

                        <input class="button" type="submit" value="Change Role">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
<!-- Content -->