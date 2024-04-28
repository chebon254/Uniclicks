<?php
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
$error = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // SQL to insert user data into the database
    $sql = "INSERT INTO signup_users (full_name, email, phone) VALUES ('$full_name', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        // User added successfully
        // Redirect to some page or display a success message
        $success = "Signup successful";
    } else {
        // Failed to add user
        $error = "Error: " . $conn->error;
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize form data
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : '';
    $communication_type = isset($_POST['communication_type']) ? mysqli_real_escape_string($conn, $_POST['communication_type']) : '';
    $communication_id = isset($_POST['communication_id']) ? mysqli_real_escape_string($conn, $_POST['communication_id']) : '';

    // SQL to insert user data into the database
    $sql = "INSERT INTO contact_users (name, email, phone, communication_type, communication_id) VALUES ('$name', '$email', '$phone', '$communication_type', '$communication_id')";

    if ($conn->query($sql) === TRUE) {
        // User added successfully
        // Redirect to some page or display a success message
        $success = "Data submitted successfully";
    } else {
        // Failed to add user
        $error = "Error: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <title>Uniclicks</title>

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

    <!-- == Style Sheet == -->
    <link rel="stylesheet" href="admin/assets/css/style.css">

    <!-- == Fonts == -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- == Icons == -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        crossorigin="anonymous" />

        <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <h1>Sign Up</h1>
        <br>
        <br>
        <div class="sign-up-form" style="width: 60%; margin: auto;">
            <form action="index.php" method="post">
                <div class="form-control text-center">
                    <img src="./admin/assets/css/img/logo.svg" alt="Uniclicks" width="100px">
                    <h1>Welcome!</h1>
                    <?php if (!empty($error)) { ?>
                        <div class="message">
                            <p id="errorMessage"><?php echo $error; ?></p>
                        </div>
                    <?php } else{ ?>
                        <div class="message">
                            <p id="successMessage"><?php echo $success; ?></p>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-control">
                    <label for="full_name">Full Name</label>
                    <br>
                    <input type="text" name="full_name" id="full_name" placeholder="Enter Full Name" required>
                </div>
                <div class="form-control">
                    <label for="email">Email</label>
                    <br>
                    <input type="email" name="email" id="email" placeholder="Enter Email" required>
                </div>
                <div class="form-control">
                    <label for="phone">Phone</label>
                    <br>
                    <input type="text" name="phone" id="phone" placeholder="Enter Phone Number" required>
                </div>
                <div class="form-control">
                    <label for="password">Password</label>
                    <br>
                    <input type="password" name="password" id="password" placeholder="Enter Password" required>
                </div>
                <div class="form-control">
                    <button class="login-btn" type="submit">Signup</button>
                </div>
            </form>
        </div>
        <br>
        <br>
        <h1>Spin Wheel</h1>
        <br>
        <br>
        <?php
$sql = "SELECT * FROM spin_prizes";
$result = $conn->query($sql);
$prizes = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $prize = array();
        foreach ($row as $key => $value) {
            $prize[$key] = $value;
        }
        $prizes[] = $prize;
    }
}
?>
        <div class="spin-wheel">
            <button id="spin">Spin</button>
            <span class="spin-wheel-arrow"></span>
            <div class="spin-wheel-container">
                <?php
                $count = count($prizes);
                $degree = 360 / $count;
                $offset = 0;
                foreach ($prizes as $key => $prize) {
                    $prizeId = isset($prize['id']) ? $prize['id'] : '';
                    $prizeName = isset($prize['name']) ? $prize['name'] : '';
                    echo '<div class="spin-wheel-item" data-prize="' . $prizeId . '" style="transform: rotate(' . $offset . 'deg);">' . $prizeName . '</div>';
                    $offset += $degree;
                }
                ?>
            </div>
        </div>
<script>
    // Fetch prize data from the server
fetch('get_prizes.php')
  .then(response => response.json())
  .then(prizes => {
    // Dynamically generate HTML for spin wheel based on prize data
    const container = document.querySelector(".spin-wheel-container");
    container.innerHTML = '';
    prizes.forEach((prize, index) => {
      const angle = index * (360 / prizes.length);
      const div = document.createElement('div');
      div.textContent = prize.spin_prizesTitle;
      div.style.transform = `rotate(${angle}deg)`;
      div.style.backgroundColor = prize.BackgroundColor;
      div.style.color = prize.TextColor;
      div.classList.add(`spin-wheel-${index + 1}`);
      container.appendChild(div);
    });
  });

</script>
        <br>
        <br>
        <h1>Offers</h1>
        <br>
        <br>
        <table class="top-offer-table">
                        <thead style="color: #ffffff !important; background-color: #269D70 !important;">
                            <tr>
                                <style>
                                    table{
                                        width: 60%;
                                        overflow: hidden;
                                        border-top-left-radius: 20px;
                                        border-top-right-radius: 20px;
                                    }
                                    th{
                                        color: #ffffff !important;
                                    }
                                </style>
                                <th></th>
                                <th>Offer</th>
                                <th>Monthly clicks</th>
                                <th>Monthly Payouts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $rowNumber = 1; // Initialize row number
                            while ($row = $result_offers->fetch_assoc()) : ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $row['offer']; ?></td>
                                    <td><?php echo number_format($row['monthly_clicks']); ?></td>
                                    <td>$<?php echo number_format($row['monthly_payouts']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
        <br>
        <br>
        <h1>Contacts</h1>
        <br>
        <br>
        <div class="contact-form" style="width: 60%; margin: auto;">
        <form action="index.php" method="post">
            <div class="form-control text-center">
                <img src="./admin/assets/css/img/logo.svg" alt="Uniclicks" width="100px">
                <h1>Welcome!</h1>
                <?php if (!empty($error)) { ?>
                    <div class="message">
                        <p id="errorMessage"><?php echo $error; ?></p>
                    </div>
                <?php } else{ ?>
                    <div class="message">
                        <p id="successMessage"><?php echo $success; ?></p>
                    </div>
                <?php } ?>
            </div>
            <div class="form-control">
                <label for="cname">Name</label>
                <br>
                <input type="text" name="name" id="cname" placeholder="Enter Name" required>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <br>
                <input type="email" name="email" id="email" placeholder="Enter Email" required>
            </div>
            <div class="form-control">
                <label for="phone">Phone</label>
                <br>
                <input type="text" name="phone" id="phone" placeholder="Enter Phone Number" required>
            </div>
            <div class="form-control">
                <label>Communication Type</label>
                <br>
                <label><input type="radio" name="communication_type" value="Skype" required> Skype</label>
                <label><input type="radio" name="communication_type" value="Telegram" > Telegram</label>
                <label><input type="radio" name="communication_type" value="Email" > Email</label>
            </div>
            <div class="form-control">
                <label for="communication_id">Communication ID</label>
                <br>
                <input type="text" name="communication_id" id="communication_id" placeholder="Enter Communication ID" required>
            </div>
            <div class="form-control">
                <button class="login-btn" type="submit">Submit</button>
            </div>
        </form>
        </div>
        <br>
        <br>
        <h1>Events</h1>
        <br>
        <br>
        <style>
            .carousel-container {
            overflow: hidden;
            width: 100%;
            }

            .carousel {
            display: flex;
            transition: transform 0.5s ease;
            }

            .carousel-item {
                position: relative;
                /* Other styles... */
            }

            .carousel-item img {
                width: 100%;
                display: block;
                /* Ensure the image covers the container */
                object-fit: cover;
                height: 100%; /* Adjust the height as needed */
            }

            .event-details {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                display: flex;
                flex-direction: column;
                justify-content: end;
                align-items: start;
                padding: 40px;
                background: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
                color: white; /* White text color */
            }

            .event-details h3,
            .event-details p {
                margin: 0;
                padding: 5px 0;
            }
            .event-details h3{
                font-size: 50px;
            }
            .event-details p {
                font-size: 20px;
                margin: 0px 0px;
            }
            /* Add navigation buttons styles */
        </style>
        <h3>Past Events</h3>
        <!-- Past Events Carousel -->
        <div class="carousel-container">
            <div id="past-events-carousel" class="carousel">
                <?php while ($row = $past_events_result->fetch_assoc()) : ?>
                    <!-- Display past events here -->
                    <div class="carousel-item">
                        <img src="admin/dashboard/thumbnails/<?php echo htmlspecialchars($row['thumbnail']); ?>" alt="Event Thumbnail">
                        <div class="event-details">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['location']); ?></p>
                            <?php
                            // Convert start and end dates to DateTime objects for comparison
                            $start_date = new DateTime($row['start_date']);
                            $end_date = new DateTime($row['end_date']);

                            // Check if start and end dates are on the same day
                            if ($start_date->format('Y-m-d') === $end_date->format('Y-m-d')) {
                                // Display only start date
                                echo "<p>" . $start_date->format('d, M Y') . "</p>";
                            } else {
                                // Check if start and end dates are in the same month
                                if ($start_date->format('Y-m') === $end_date->format('Y-m')) {
                                    // Display start date day and end date day month and year
                                    echo "<p>" . $start_date->format('d') . " - " . $end_date->format('d, M Y') . "</p>";
                                } else {
                                    // Display both start and end dates
                                    echo "<p>" . $start_date->format('d, M Y') . " - " . $end_date->format('d, M Y') . "</p>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <br>
        <h3>Upcoming Events</h3>
        <!-- Upcoming Events Carousel -->
        <div class="carousel-container">
            <div id="upcoming-events-carousel" class="carousel">
                <?php while ($row = $upcoming_events_result->fetch_assoc()) : ?>
                    <!-- Display upcoming events here -->
                    <div class="carousel-item">
                        <img src="admin/dashboard/thumbnails/<?php echo htmlspecialchars($row['thumbnail']); ?>" alt="Event Thumbnail">
                        <div class="event-details">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['location']); ?></p>
                            <?php
                            // Convert start and end dates to DateTime objects for comparison
                            $start_date = new DateTime($row['start_date']);
                            $end_date = new DateTime($row['end_date']);

                            // Check if start and end dates are on the same day
                            if ($start_date->format('Y-m-d') === $end_date->format('Y-m-d')) {
                                // Display only start date
                                echo "<p>" . $start_date->format('d, M Y') . "</p>";
                            } else {
                                // Check if start and end dates are in the same month
                                if ($start_date->format('Y-m') === $end_date->format('Y-m')) {
                                    // Display start date day and end date day month and year
                                    echo "<p>" . $start_date->format('d') . " - " . $end_date->format('d, M Y') . "</p>";
                                } else {
                                    // Display both start and end dates
                                    echo "<p>" . $start_date->format('d, M Y') . " - " . $end_date->format('d, M Y') . "</p>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <br>
        <br>
    </div>
    <!-- == Scripts == -->
    <script src="js/script.js" defer></script>
    <script src="assets/js/spin.js"></script>
    <script>
        let currentIndexPast = 0;
let currentIndexUpcoming = 0;

function moveCarousel(carouselId, index) {
  const carousel = document.getElementById(carouselId);
  const totalItems = carousel.children.length;
  const itemWidth = carousel.children[0].offsetWidth;
  const newTransformValue = index * -itemWidth;

  if (index >= 0 && index < totalItems) {
    carousel.style.transform = `translateX(${newTransformValue}px)`;
    if (carouselId === 'past-events-carousel') {
      currentIndexPast = index;
    } else {
      currentIndexUpcoming = index;
    }
  }
}

// Example usage: moveCarousel('past-events-carousel', 1);
// Add event listeners to your navigation buttons to call moveCarousel function
    </script>
</body>

</html>