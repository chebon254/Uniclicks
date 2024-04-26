/* == Login Password input Eye == */
const togglePassword = document.querySelector("#togglePassword");
const passwordInput = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
    this.classList.toggle("fa-eye");
    this.classList.toggle("fa-eye-slash");
});
/* == || Login Password input Eye == */


/* == Dashboard == */
// Function to open a tab
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("dash-tab-content");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tab-btn");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  
    // Save the active tab to local storage
    localStorage.setItem("activeTab", tabName);
  }
  
  // Get the active tab from local storage and open it
  document.addEventListener("DOMContentLoaded", function() {
    var activeTab = localStorage.getItem("activeTab");
    if (activeTab) {
      document.getElementById(activeTab).style.display = "block";
      var tablinks = document.getElementsByClassName("tab-btn");
      for (var i = 0; i < tablinks.length; i++) {
        if (tablinks[i].getAttribute("onclick").includes(activeTab)) {
          tablinks[i].className += " active";
          break;
        }
      }
    } else {
      // If no active tab is found, default to the first tab
      document.getElementsByClassName("dash-tab-content")[0].style.display = "block";
      document.getElementsByClassName("tab-btn")[0].className += " active";
    }
  });
  
/* == || Dashboard == */