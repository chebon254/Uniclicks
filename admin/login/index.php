<?php

include '../connect/database.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables and redirect to dashboard
            $_SESSION['username'] = $username;
            header("location: ../dashboard");
            exit;
        } else {
            // Password is incorrect, set error message
            $error = "Wrong password!";
        }
    } else {
        // User does not exist, set error message
        $error = "User does not exist!";
    }

    $stmt->close();
    mysqli_close($conn);
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

    <title>Uniclicks Login</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/css/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/css/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../assets/css/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/css/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/css/favicon/site.webmanifest">
    <link rel="mask-icon" href="../assets/css/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="../assets/css/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../assets/css/favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="../assets/css/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- == Style Sheet == -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- == Fonts == -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- == Icons == -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" />

</head>

<body class="login-pg">
    <main class="login-pg">
        <div class="container login-pg-container">
            <div class="card one">
                <img src="../assets/css/img/unclicks image.png" alt="Uniclicks">
            </div>
            <div class="card two">
                <form action="index.php" method="post">
                    <div class="form-control text-center">
                        <img src="../assets/css/img/logo.svg" alt="Uniclicks" width="100px">
                        <h1>Welcome!</h1>
                        <?php if (!empty($error)) { ?>
                            <div class="message">
                                <p id="errorMessage"><?php echo $error; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-control">
                        <label for="username">Username</label>
                        <br>
                        <div class="input-container">
                            <i class="fa-solid fa-user-shield"></i>
                            <input type="text" name="username" placeholder="Enter username">
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="password">Password</label>
                        <br>
                        <div class="password-container">
                            <i class="fa-solid fa-shield-halved"></i>
                            <input type="password" name="password" id="password" placeholder="Enter Password" required>
                            <i class="fas fa-eye-slash" id="togglePassword"></i>
                        </div>
                    </div>
                    <div class="form-control">
                        <button class="login-btn" type="submit">Login</button>
                        <p class="back-link">Go back to website<a href="../../">Uniclicks</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!-- == Scripts == -->
    <script src="../assets/js/script.js"></script>
    <script>
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
    </script>
</body>

</html>
