// event handler for sign up button
function signup() {
  var user = $(
    '<div><span>Welcome, Samnyeong  </span><button class="button user" onclick="logout()">Log out</button></div>'
  );

  $(".login")
    .empty()
    .append(user);

  overlayOff();
}

// event handler for log in button
function login() {
  var user = $(
    '<div><span>Welcome, Samnyeong  </span><button class="button user" onclick="logout()">Log out</button></div>'
  );

  $(".login")
    .empty()
    .append(user);

  overlayOff();
}

function overlayOn() {
  document.getElementById("overlay").style.display = "block";
}

function overlayOff() {
  console.log("test");
  document.getElementById("overlay").style.display = "none";
}

function logout() {
  var button = $(
    '<button class="button signup" onclick="signup()">Sign up</button>' +
      '<button class="button login" onclick="login()">Log in</button>'
  );

  $(".login")
    .empty()
    .append(button);

  overlayOn();
}
