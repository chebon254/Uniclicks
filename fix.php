<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include './admin/connect/database.php';

// Fetch contact form data
$top_offers = "SELECT `id`, `offer`, `monthly_clicks`, `monthly_payouts` FROM `top_offers`";
$result_offers = $conn->query($top_offers);

// Fetch past events
$past_events_query = "SELECT `id`, `title`, `location`, `start_date`, `end_date`, `thumbnail` FROM `events` WHERE end_date < CURDATE()";
$past_events_result = $conn->query($past_events_query);

// Fetch upcoming events
$upcoming_events_query = "SELECT `id`, `title`, `location`, `start_date`, `end_date`, `thumbnail` FROM `events` WHERE end_date >= CURDATE()";
$upcoming_events_result = $conn->query($upcoming_events_query);

// Initialize error message
$signup_error = "";
$contact_error = "";
$contact_success ="";
$signup_success ="";

// // Check if form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Fetch and sanitize form data
//     $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
//     $email = mysqli_real_escape_string($conn, $_POST['email']);
//     $phone = mysqli_real_escape_string($conn, $_POST['phone']);

//     // SQL to insert user data into the database
//     $sql = "INSERT INTO signup_users (full_name, email, phone) VALUES ('$full_name', '$email', '$phone')";

//     if ($conn->query($sql) === TRUE) {
//         // User added successfully
//         // Redirect to some page or display a success message
//         $signup_success = "Signup successful";
//     } else {
//         // Failed to add user
//         $signup_error = "Error: " . $conn->error;
//     }
// }

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Fetch and sanitize form data
  $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
  $company = isset($_POST['company']) ? mysqli_real_escape_string($conn, $_POST['company']) : '';
  $communication_type = isset($_POST['communication_type']) ? mysqli_real_escape_string($conn, $_POST['communication_type']) : '';
  $communication_id = isset($_POST['communication_id']) ? mysqli_real_escape_string($conn, $_POST['communication_id']) : '';
  $message = isset($_POST['message']) ? mysqli_real_escape_string($conn, $_POST['message']) : '';

  // SQL to insert user data into the database
  $sql = "INSERT INTO contact_users (name, company, communication_type, communication_id, message, counter) VALUES ('$name', '$company', '$communication_type', '$communication_id', '$message', 2)";

  if ($conn->query($sql) === TRUE) {
      $userId = $conn->insert_id;
      echo "<script> localStorage.setItem('userId', $userId); var canSpin = true; </script>";
      
      exit; 
  } else {
      $contact_error = "Error: " . $conn->error;
      echo json_encode(array('message' => $contact_error));
      error_log(json_encode(array('message' => $contact_error))); // Log the error for debugging
      exit;
  }
}

// Fetch spin wheel data from the database
$spin_sql = "SELECT `spin_prizesTitle`, `Probability`, `BackgroundColor`, `TextColor` FROM `spin_prizes`";
$spin_result = $conn->query($spin_sql);

$prizewon_success = "";
$prizewon_error = "";

// Store the fetched data in an array
$spinWheelData = array();
if ($spin_result->num_rows > 0) {
    while ($row = $spin_result->fetch_assoc()) {
        $spinWheelData[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Uniclicks</title>
  <meta name="description" lang="en" content="Uniclicks" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <!-- == META OG Social Media Ads == -->
  <meta property="og:title" content="Uniclicks" />
  <meta property="og:url" content="https://uniclicks.com" />
  <meta property="og:image" content="https://uniclicks.com/admin/css/img/social media/Facebook.png" />
  <meta property="og:type" content="website" />
  <meta property="og:desc revealription" content="We Grow Together With Each Click" />

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@uniclicks">
  <meta name="twitter:title" content="Uniclicks">
  <meta name="twitter:desc revealription" content="We Grow Together With Each Click">
  <meta name="twitter:image" content="https://uniclicks.com/admin/css/img/social media/Twitter.png">
  <meta name="twitter:player" content="https://uniclicks.com">
  <meta name="twitter:player:width" content="280">
  <meta name="twitter:player:height" content="150">


  <link rel="apple-touch-icon" sizes="180x180" href="admin/assets/css/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="admin/assets/css/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="192x192" href="admin/assets/css/favicon/android-chrome-192x192.png">
  <link rel="icon" type="image/png" sizes="16x16" href="admin/assets/css/favicon/favicon-16x16.png">
  <link rel="manifest" href="admin/assets/css/favicon/site.webmanifest">
  <link rel="mask-icon" href="admin/assets/css/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="admin/assets/css/favicon/favicon.ico">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="admin/assets/css/favicon/mstile-144x144.png">
  <meta name="msapplication-config" content="admin/assets/css/favicon/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  <link rel="preload" href="fonts/Inter-Regular.woff2" as="font" type="font/woff2" crossorigin />
  <link rel="preload" href="fonts/GoogleSans-Medium.woff2" as="font" type="font/woff2" crossorigin />
  <link rel="preload" href="fonts/GoogleSans-Bold.woff2" as="font" type="font/woff2" crossorigin />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script defer="defer" src="js/script.js"></script>
  <!-- == Icons == -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        crossorigin="anonymous" />
  <!-- Include jQuery from a CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
</head>
<body>
  <div class="wrapper" data-overlay="false">
    <main>
      <section id="about" class="about">
        <div class="container">
          <div class="about__wrapper">
            <div class="about-img">
              <div class="spinwheel-container" align="center">
                <span class="spin-wheel-arrow"><i class="fa-solid fa-down-long"></i></span>
                <div id="wheel" style="width: 460px;">
                    <canvas id="canvas" width="460" height="460"></canvas>
                </div>
                <button type="button" class="btn btn-success">Spin!</button>
                <div id="no-spin-alert">
                  <p>Fill the Contact us form to <br> get a chance to spin.</p>
                  <div class="square"></div>
                </div>
              </div> 
            </div>
            <div class="about-info">
              <h2 class="title about-info__title">About Us</h2>
              <div class="about-info__text">
                <p>
                  Not just an affiliate network company, but your team
                  of dedicated experts. We offer a great importance
                  to communication, steadfast support and top notch
                  technologies to ensure thriving collaboration.
                </p>
                <p>
                  Join forces with our talented, ambitious, and driven team.
                  You’ll discover a collaborative approach infused with
                  professionalism. Trust is the cornerstone of successful
                  partnerships. That’s why we work daily to enhance the
                  quality of our partnerships, ensuring mutual success.
                </p>
              </div>
              <button type="button" class="btn-main about-info__btn triggerModalForm">
                Contact Us
              </button>
            </div>
          </div>
        </div>
      </section>
    </main>
    <div class="modal modal-form">
      <div class="modal__wrapper">
        <div class="modal__content">
          <button class="modal__close modal-form__close" aria-label="Close modal window"></button>
          <form action="index.php" method="post" id="contactForm" class="form-win">
            <div class="form__wrapper">
              <div class="form-block">
                <h1 class="form-block__title">Send Request</h1>
                <div class="message" id="formMessage"></div>
                <div class="form-block__wrap">
                  <input type="text" name="name" id="cname" class="form-block__input" placeholder="Name:" />
                  <input type="text" name="company" id="company" class="form-block__input" placeholder="Company:" />
                  <div class="form-block__wrapper">
                    <div class="form-block__text">Сommunication in:</div>
                    <input class="custom-radio" name="communication_type" type="radio" id="radio-skype" value="Skype" />
                    <label for="radio-skype">Skype</label>
                    <input class="custom-radio" name="communication_type" type="radio" id="radio-telegram" value="Telegram" />
                    <label for="radio-telegram">Telegram</label>
                    <input class="custom-radio" name="communication_type" type="radio" id="radio-email" value="Email" />
                    <label for="radio-email">Email</label>
                  </div>
                  <input type="text" name="communication_id" id="communication_id" class="form-block__input" placeholder="Your Skype ID, Telegram, Email" />
                  <input type="text" name="message" id="message-input" class="form-block__input" placeholder="Your message:" />
                </div>
                <button type="submit" class="form-block__btn">
                  Submit Request
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="popup-container" id="popup-container">
        <div class="popup-card">
            <div id="win-card" style="display: none;">
                <h2>Congratulations!</h2>
                <p>You won <span id="win-prize"></span></p>
                <button class="btn">OK</button>
            </div>
            <div id="lose-card" style="display: none;">
                <h2>Sorry!</h2>
                <p>Oops! <span id="lose-prize"></span> You didn't win. Try again!</p>
                <button class="btn">OK</button>
            </div>
        </div>
    </div>
  </div>

  <script>
    var userId = localStorage.getItem('userId') || 0;
    console.log('Retrieved userId:', userId);
    var canSpin = userId != 0;
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const spinButton = document.querySelector('.btn.btn-success');
    const noSpinAlert = document.getElementById('no-spin-alert');
    let alertTimeout;

    spinButton.addEventListener('click', function() {
      if (userId === 0) {
        // Show the alert if userId is zero
        noSpinAlert.style.display = 'block';

        // If there's an existing timeout, clear it
        clearTimeout(alertTimeout);

        // Set a new timeout to hide the alert after 3 seconds
        alertTimeout = setTimeout(function() {
          noSpinAlert.style.display = 'none';
        }, 3000); // 3 seconds
      } else {
        // Proceed with the spin functionality if userId is not zero
        spin();
      }
    });
  });
  </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');

    contactForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(contactForm);

        fetch('index.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.text(); // Get the response text
        })
        .then(responseText => {
            console.log('Response Text:', responseText); // Log the response text
            try {
                const data = JSON.parse(responseText); // Parse the response as JSON
                console.log('JSON response:', data); // Log JSON response
                if (data.userId) {
                    localStorage.setItem('userId', data.userId);
                    userId = data.userId;
                    canSpin = true;
                    console.log('Updated userId:', userId);
                    console.log('Can spin:', canSpin);
                }
                if (data.message && data.message.includes('Message sent successfully')) {
                    formMessage.innerHTML = `<p id="successMessage" style="text-align: center; color: green;">${data.message}</p>`;
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                } else {
                    formMessage.innerHTML = `<p id="errorMessage" style="text-align: center; color: red;">${data.message}</p>`;
                }
            } catch (error) {
                formMessage.innerHTML = `<p id="errorMessage" style="text-align: center; color: red;">Error: ${error.message}</p>`;
            }
        })
        .catch(error => {
            formMessage.innerHTML = `<p id="errorMessage" style="text-align: center; color: red;">Error: ${error.message}</p>`;
        });
    });
});
</script>

<script>
      var spinWheelData = <?php echo json_encode($spinWheelData); ?>;
      function create_spinner() {
          var slices = spinWheelData.length;
          var sliceDeg = 360 / slices;
          var deg = rand(0, 360);
          var ctx = canvas.getContext('2d');
          var width = canvas.width; // size
          var center = width / 2;      // center

          ctx.clearRect(0, 0, width, width);
          for (var i = 0; i < slices; i++) {
              ctx.beginPath();
              ctx.fillStyle = spinWheelData[i]['BackgroundColor'];
              ctx.moveTo(center, center);
              ctx.arc(center, center, width / 2, deg2rad(deg), deg2rad(deg + sliceDeg));
              ctx.lineTo(center, center);
              ctx.fill();
              var drawText_deg = deg + sliceDeg / 2;
              ctx.save();
              ctx.translate(center, center);
              ctx.rotate(deg2rad(drawText_deg));
              ctx.textAlign = "center"; // Adjusted to center text horizontally
              ctx.textBaseline = "middle"; // Adjusted to center text vertically
              ctx.fillStyle = spinWheelData[i]['TextColor'];
              ctx.font = 'bold 15px sans-serif';
              ctx.fillText(spinWheelData[i]['spin_prizesTitle'], 100, 5);
              ctx.restore();
              deg += sliceDeg;
          }
      }
      create_spinner();

      var deg = rand(0, 360);
      var speed = 0;
      var ctx = canvas.getContext('2d');
      var width = canvas.width; // size
      var center = width / 2;      // center
      var isStopped = false;
      var lock = false;
      var slowDownRand = 0;

      function spin() {
          var slices = spinWheelData.length;
          var sliceDeg = 360 / slices;
          deg += speed;
          deg %= 360;
          // Instant fast speed
          if (!isStopped && speed < 30) {
              speed = speed + 2;
          }
          // Stopped!
          if (isStopped) {
              if (!lock) {
                  lock = true;
                  slowDownRand = rand(0.986, 0.990);
              }
              speed = speed > 0.2 ? speed *= slowDownRand : 0;
          }
          // Stopped after 6 seconds
          if (lock && !speed) {
              var ai = Math.floor(((360 - deg - 90) % 360) / sliceDeg); // deg 2 Array Index
              ai = (slices + ai) % slices; // Fix negative index
              var winProbability = spinWheelData[ai]['Probability'];
              var randomNumber = 21;

              if (randomNumber > winProbability) {
                  showWinPopup(spinWheelData[ai]['spin_prizesTitle']);
              } else {
                  showLosePopup(spinWheelData[ai]['spin_prizesTitle']);
              }
          }
          ctx.clearRect(0, 0, width, width);
          for (var i = 0; i < slices; i++) {
              ctx.beginPath();
              ctx.fillStyle = spinWheelData[i]['BackgroundColor'];
              ctx.moveTo(center, center);
              ctx.arc(center, center, width / 2, deg2rad(deg), deg2rad(deg + sliceDeg));
              ctx.lineTo(center, center);
              ctx.fill();
              var drawText_deg = deg + sliceDeg / 2;
              ctx.save();
              ctx.translate(center, center);
              ctx.rotate(deg2rad(drawText_deg));
              ctx.textAlign = "center"; // Adjusted to center text horizontally
              ctx.textBaseline = "middle"; // Adjusted to center text vertically
              ctx.fillStyle = spinWheelData[i]['TextColor'];
              ctx.font = 'bold 15px sans-serif';
              ctx.fillText(spinWheelData[i]['spin_prizesTitle'], 100, 5);
              ctx.restore();
              deg += sliceDeg;
          }
          window.requestAnimationFrame(spin);
      }

      setTimeout(function () {
          isStopped = true;
      }, 6000);

      function deg2rad(deg) {
          return deg * Math.PI / 180;
      }
      function rand(min, max) {
          return Math.random() * (max - min) + min;
      }
  </script>
</body>

</html>