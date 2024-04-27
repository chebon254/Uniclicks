/* == Dashboard == */
// Dummy data for messages and notifications
const messages = [
  { sender: 'John Doe', preview: 'Hello, how are you?' },
  { sender: 'Jane Smith', preview: 'Meeting at 3 PM today.' },
  { sender: 'Bob Johnson', preview: 'Project update' },
];

const notifications = [
  { title: 'New comment on your post' },
  { title: 'Someone mentioned you' },
];

// Function to populate message dropdown
function populateMessageDropdown() {
  const messageDropdown = document.querySelector('.message-dropdown');
  messageDropdown.innerHTML = '';

  messages.forEach(message => {
    const messageItem = document.createElement('div');
    messageItem.textContent = `${message.sender}: ${message.preview}`;
    messageDropdown.appendChild(messageItem);
  });
}

// Function to populate notification dropdown
function populateNotificationDropdown() {
  const notificationDropdown = document.querySelector('.notification-dropdown');
  notificationDropdown.innerHTML = '';

  notifications.forEach(notification => {
    const notificationItem = document.createElement('div');
    notificationItem.textContent = notification.title;
    notificationDropdown.appendChild(notificationItem);
  });
}

// Call the population functions when the page loads
window.addEventListener('load', () => {
  populateMessageDropdown();
  populateNotificationDropdown();
});
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
      var tablinks = document.getElementsByClassName("tab-btn");
      for (var i = 0; i < tablinks.length; i++) {
          if (tablinks[i].getAttribute("onclick").includes(activeTab)) {
              tablinks[i].click(); // Simulate click on the active tab
              break;
          }
      }
  } else {
      // If no active tab is found, default to the first tab
      document.getElementsByClassName("dash-tab-content")[0].style.display = "block";
      document.getElementsByClassName("tab-btn")[0].className += " active";
  }
});

document.addEventListener("DOMContentLoaded", function() {
  // Add event listener to the button to display the form
  document.getElementById("add-offers-btn").addEventListener("click", function() {
    // Get the form container
    var formContainer = document.querySelector(".exloretb-form");
    // Set its display property to "block"
    formContainer.style.display = "block";
  });

  // Check if the cancel button exists before adding event listener
  var cancelButton = document.getElementById("cancel-btn-form");
  if (cancelButton) {
    // Add event listener to the cancel button in the form
    cancelButton.addEventListener("click", function() {
      // Get the form container
      var formContainer = document.querySelector(".exloretb-form");
      // Set its display property back to "none" to hide it
      formContainer.style.display = "none";
    });
  }
});

document.addEventListener("DOMContentLoaded", function() {
  // Add event listener to the button to display the form
  document.getElementById("prizestb-add-prize-btn").addEventListener("click", function() {
    // Get the form container
    var formContainer = document.querySelector(".prizestb-form");
    // Set its display property to "block"
    formContainer.style.display = "block";
  });

  // Check if the cancel button exists before adding event listener
  var cancelButton = document.getElementById("prizestbcancel-btn-form");
  if (cancelButton) {
    // Add event listener to the cancel button in the form
    cancelButton.addEventListener("click", function() {
      // Get the form container
      var formContainer = document.querySelector(".prizestb-form");
      // Set its display property back to "none" to hide it
      formContainer.style.display = "none";
    });
  }
});

document.addEventListener("DOMContentLoaded", function() {
  // Add event listener to the button to display the form
  document.getElementById("add-event-btn").addEventListener("click", function() {
    // Get the form container
    var formContainer = document.querySelector(".eventstb-form");
    // Set its display property to "block"
    formContainer.style.display = "block";
  });

  // Check if the cancel button exists before adding event listener
  var cancelButton = document.getElementById("eventcancel-btn-form");
  if (cancelButton) {
    // Add event listener to the cancel button in the form
    cancelButton.addEventListener("click", function() {
      // Get the form container
      var formContainer = document.querySelector(".eventstb-form");
      // Set its display property back to "none" to hide it
      formContainer.style.display = "none";
    });
  }
});
/* == || Dashboard == */