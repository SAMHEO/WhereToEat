$(document).ready(function() {
  // Autocomplete search functionality
  // Find the most relevant dining hall name from database based on users' search result
  $("#search").keyup(function() {
    $.ajax({
      type: "GET",
      url: base_url + "/index/readDining",
      data: "keyword=" + $(this).val(),
      success: function(data) {
        $("#suggestion-box").show();
        $("#suggestion-box").html(data);
        $("#search-box").css("background", "#222");
      }
    });
  });
});

// Fill the search box with the selected dining hall name
function selectDining(val) {
  $("#search").val(val);
  $("#suggestion-box").hide();
}

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

// Delete review using ajax
function confirmDelete() {
  // ask user for confirmation
  var answer = window.confirm("Do you really want to delete the review?");
  if (answer == true) {
    // if confirmed

    // looking for dining name
    var diningName = $("p[id^='dining-name']")
      .attr("id")
      .substr(12);

    // looking for review ID
    var id = $(".button.delete")
      .parent()
      .attr("id");
    var reviewID = parseInt(id.substr(12));

    // Sending ajax request to the database
    $.post(
      base_url + "/detail/delete/process",
      {
        review_id: reviewID,
        dining_name: diningName
      },
      function(data) {
        if (data.success == "success") {
          $("#user-review-" + data.id).remove();
        } else {
          alert("Error: " + data.error);
        }
      }
    );
  } else {
    // if not confirmed
    return false;
  }
}
