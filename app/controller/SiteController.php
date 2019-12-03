<?php

include_once '../global.php';

$route = $_GET['route'];

$sc = new SiteController();

if ($route == 'index') {
  $sc->home();
} elseif ($route == 'signup') {
  $sc->signup();
} elseif ($route == 'signupProcess') {
  $sc->signupProcess();
} elseif ($route == 'login') {
  $sc->login();
} elseif ($route == 'loginProcess') {
  $sc->loginProcess();
} elseif ($route == 'logout') {
  $sc->logout();
} elseif ($route == 'profile') {
  $sc->profile();
} elseif ($route == 'admin') {
  $sc->admin();
} elseif ($route == 'changePasswordProcess') {
  $sc->changePasswordProcess();
} elseif ($route == 'update') {
  $sc->updateRole();
}

class SiteController
{
  public function signup()
  {
    $pageTitle = "Sign Up";

    include_once SYSTEM_PATH . '/view/header.php';
    include_once SYSTEM_PATH . '/view/signup.php';
    include_once SYSTEM_PATH . '/view/footer.php';
  }

  public function signupProcess()
  {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    $user = new User();
    $user->firstname = $firstname;
    $user->lastname = $lastname;
    $user->username = $username;
    $user->password = $password;
    $user->email = $email;
    $user->gender = $gender;

    $user = User::insertUser($user);

    if ($user == null) {
      $_SESSION['msg'] = 'User already Existed';
      header('Location: ' . BASE_URL . '/login');
      exit();
    } else {
      $_SESSION['loggedInUserID'] = $user->id;
      $_SESSION['loggedInUserRole'] = $user->role;
      $_SESSION['msg'] = 'Signup successful!';
      header('Location: ' . BASE_URL . '/index');
      exit();
    }
  }

  public function login()
  {
    $pageTitle = "Login";

    include_once SYSTEM_PATH . '/view/header.php';
    include_once SYSTEM_PATH . '/view/login.php';
    include_once SYSTEM_PATH . '/view/footer.php';
  }

  public function loginProcess()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = User::loadByUsername($username);



    if ($user == null) {
      $_SESSION['msg'] = 'Login failed. Your username or password is incorrect.';
      header('Location: ' . BASE_URL . '/login');
      exit();
    } elseif ($user->password != $password) {
      $_SESSION['msg'] = 'Login failed. Your username or password is incorrect.';
      header('Location: ' . BASE_URL . '/login');
      exit();
    } else {
      //$_SESSION['username'] = $username;
      $_SESSION['loggedInUserID'] = $user->id;
      $_SESSION['loggedInUserRole'] = $user->role;
      $_SESSION['msg'] = 'Login successful!';

      // log the event
      $ev = new Event();
      $ev->event_type = Event::EVENT_TYPE['login'];
      $ev->user_1_id = $_SESSION['loggedInUserID'];
      $ev = Event::insertEvent($ev);
      header('Location: ' . BASE_URL . '/index');
      exit();
    }
  }

  public function logout()
  {
    // log the event
    $ev = new Event();
    $ev->event_type = Event::EVENT_TYPE['logout'];
    $ev->user_1_id = $_SESSION['loggedInUserID'];
    $ev = Event::insertEvent($ev);

    unset($_SESSION['loggedInUserID']);
    session_destroy();
    header('Location: ' . BASE_URL . '/login');
    exit();
  }

  public function home()
  {
    $pageTitle = "Home";

    include_once SYSTEM_PATH . '/view/header.php';
    include_once SYSTEM_PATH . '/view/index.php';
    include_once SYSTEM_PATH . '/view/footer.php';
  }

  public function profile()
  {
    $username = $_GET['username'];

    $user = User::loadByUsername($username);
    $events = Event::loadByUserID($user->id);

    if ($user == null) {
      $_SESSION['msg'] = 'User does not exist.';
      header('Location: ' . BASE_URL . '/index');
      exit();
    } else {
      $pageTitle = $username . "'s Profile";
      include_once SYSTEM_PATH . '/view/header.php';
      include_once SYSTEM_PATH . '/view/profile.php';
      include_once SYSTEM_PATH . '/view/footer.php';
    }
  }

  public function admin()
  {
    $pageTitle = "Admin Page";

    $users = User::loadAllUsers();
    include_once SYSTEM_PATH . '/view/header.php';
    include_once SYSTEM_PATH . '/view/admin.php';
    include_once SYSTEM_PATH . '/view/footer.php';
  }

  public function changePasswordProcess()
  {
    $password = $_POST['password'];

    $user = User::loadByID($_SESSION['loggedInUserID']);
    $username = $user->username;
    $user->password = $password;

    $user = User::changePassword($user);


    $_SESSION['msg'] = 'Password successfully changed!';
    header('Location: ' . BASE_URL . '/user/' . $username);
    exit();
  }

  public function updateRole()
  {
    $username = $_POST['username'];
    $role = $_POST['role'];

    $user = User::loadByUsername($username);
    $user->role = $role;

    $user = User::updateRole($user);
    header('Location: ' . BASE_URL . '/admin');
    exit();
  }
}
