<?php include_once SYSTEM_PATH . '/view/helpers.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/css/styles.css" media="screen" />
  <script>
    var base_url = '<?= BASE_URL ?>'; // give JS access to PHP's BASE_URL
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="<?= BASE_URL ?>/public/js/scripts.js"></script>
  <?php if (isset($script)) : ?>
    <script src="<?= BASE_URL ?>/public/js/<?= $script ?>.js"></script>
  <?php endif; ?>
  <title>Where To Eat | <?= $pageTitle ?></title>
</head>

<body>
  <div class="header">
    <div class="header-left">
      <div class="logo">
        <a href="<?= BASE_URL ?>/index">
          <img src="<?= BASE_URL ?>/public/images/logo.svg" alt="logo" width="80px" height="50px" />
          <!--<a href="http://www.onlinewebfonts.com">oNline Web Fonts</a>-->
          <div class="title">
            <h1>Where To Eat</h1>
          </div>
        </a>
      </div>
    </div>
    <div class="header-right">
      <div class="nav">
        <ul>
          <li><a href="<?= BASE_URL ?>/index" <?php if ($pageTitle == 'Home') {
                                                echo ' class="active"';
                                              } ?>>Home</a></li>
          <li><a href="<?= BASE_URL ?>/dining" <?php if ($pageTitle == 'Dining' || $pageTitle == "Detail") {
                                                  echo ' class="active"';
                                                } ?>>Dining Halls</a></li>
        </ul>
      </div>
      <div class="login">
        <?php if (isset($_SESSION['loggedInUserID'])) : ?>
          <button class="button signup">Welcome, <strong><?= createUsernameLink($_SESSION['loggedInUserID']) ?></strong></button>
          <?php if ($_SESSION['loggedInUserRole'] == User::ROLE['admin']) : ?>
            <a href="<?= BASE_URL ?>/admin"><button class="button">Admin</button></a>
          <?php endif; ?>
          <a href="<?= BASE_URL ?>/logout">
            <button class="button login">Log Out</button>
          </a>
        <?php else : ?>
          <a href="<?= BASE_URL ?>/signup">
            <button class="button signup">Sign up</button>
          </a>
          <a href="<?= BASE_URL ?>/login">
            <button class="button login">Log in</button>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- Header -->