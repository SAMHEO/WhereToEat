<!-- Content -->
<div class="detail-content">
    <div class="center-template">
        <h1>Signup</h1>

        <form id="signup" action="<?= BASE_URL ?>/signup/process" method="post">
            <input class="text" type="text" name="firstname" placeholder="First Name" required="">
            <input class="text" type="text" name="lastname" placeholder="Last Name" required="">
            <input class="text" type="email" name="email" placeholder="Email Address" required="">

            <input class="text" type="text" name="username" placeholder="Username" required="">
            <input class="text" type="password" name="password" placeholder="Password" required="">
            <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <input class="button" type="submit" value="SIGNUP">
        </form>
    </div>

</div>

<!-- Content -->

<?php if (isset($_SESSION['msg'])) : ?>
    <div id="msg">
        <?= $_SESSION['msg'] ?>
    </div>
    <?php unset($_SESSION['msg']); ?>
<?php endif; ?>