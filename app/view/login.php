<!-- Content -->
<div class="detail-content">
  <div class="center-template">
    <h1>Login</h1>

    <?php if (isset($_SESSION['msg'])) : ?>
      <div id="msg">
        <?= $_SESSION['msg'] ?>
      </div>
      <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>

    <form id="login" method="POST" action="<?= BASE_URL ?>/login/process">
      <input id="un" name="username" type="text" placeholder="Username">

      <input id="pw" name="password" type="password" placeholder="Password">

      <input class="button" type="submit" value="Login">
    </form>
  </div>
</div>
<!-- Content -->