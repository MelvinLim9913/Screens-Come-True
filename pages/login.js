function openTab(evt, activity) {
  // var url = document.location.toString();
  // console.log(url)
  // var tab;
  // if (url.match('#')) { 
  //   tab = url.split('#')[1];
  //   if (tab == "register") {}
  //     activity = tab;
  //   }
  // }
    // Declare all variables
    var i, tabcontent, tablinks;
    // activity = tab;
    console.log(evt, activity);
    
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(activity).style.display = "block";
    evt.currentTarget.className += " active";
  }

function validateEmail() {
    var email = document.getElementById("registeremail").value;
    var regexEmail = /^[\w.-]+@(\w+\.){1,3}\w{2,3}$/;
    var retEmail = regexEmail.test(email);
    console.log(email)
    if (!retEmail) {
        alert("Invalid email");
    }
}

function validateValidPassword() {
  var password = document.getElementById("registerpassword").value;
  var regexPassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
  var retPassword = regexPassword.test(password)
  if (!retPassword) {
    alert("Password must be at least six characters, including letter and number");
  }
}

function validatePassword() {
  var registerpassword = document.getElementById("registerpassword").value;
  console.log(registerpassword)
  var registerconfirmpassword = document.getElementById("registerconfirmpassword").value;
  console.log(registerconfirmpassword)
  if (registerpassword !== registerconfirmpassword) {
    alert("Password doesn't match");
  }
}

function validateForm() {
    'use strict';

    var email = document.getElementById("registeremail").value;
    var regexEmail = /^[\w.-]+@(\w+\.){1,3}\w{2,3}$/;
    var retEmail = regexEmail.test(email);
    if (!retEmail) {
        alert("Invalid email");
        return false;
    }

    var password = document.getElementById("registerpassword").value;
    var regexPassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
    var retPassword = regexPassword.test(password)
    if (!retPassword) {
      alert("Password must be at least six characters, including letter and number");
      return false;
    }

    var registerpassword = document.getElementById("registerpassword").value;
    var registerconfirmpassword = document.getElementById("registerconfirmpassword").value;
    if (registerpassword !== registerconfirmpassword) {
        alert("Password doesn't match");
        return false;

    }

}

function init() {
    'use strict';
    
    // Confirm that document.getElementById() can be used:
    if (document && document.getElementById) {
        var loginForm = document.getElementById('formregister');
        loginForm.onsubmit = validateForm;
    }

} // End of init() function.

// Assign an event listener to the window's load event:
window.onload = init;