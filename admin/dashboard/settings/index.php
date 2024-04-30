<?php
// Start session
session_start();

// Database connection
include '../../connect/database.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../../login");
    exit;
}

$error = $success = "";

// Check if the password change form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Validate the new password and confirm password
    if ($new_password === $confirm_new_password) {
        // Get the current password hash from the database
        $stmt = $conn->prepare("SELECT password FROM admin WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $current_password_hash = $row['password'];

            // Verify the current password
            if (password_verify($current_password, $current_password_hash)) {
                // Hash the new password
                $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
                $stmt->bind_param("si", $new_password_hash, $_SESSION['user_id']);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $success = "Password changed successfully.";
                } else {
                    $error = "Failed to change password. Please try again.";
                }
            } else {
                $error = "Current password is incorrect.";
            }
        } else {
            $error = "User not found.";
        }
    } else {
        $error = "New password and confirm password do not match.";
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

    <title>Uniclicks Settings</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../assets/css/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/css/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../../assets/css/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/css/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../assets/css/favicon/site.webmanifest">
    <link rel="mask-icon" href="../../assets/css/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="../../assets/css/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../../assets/css/favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="../../assets/css/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- == Style Sheet == -->
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- == Fonts == -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- == Icons == -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        crossorigin="anonymous" />

    <!-- Include inline styles -->
    <!-- <style>
        .password-container {
            position: relative;
        }

        .password-container input {
            padding-right: 30px; /* Make room for the eye icon */
        }

        .password-container i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style> -->
</head>
<body>
    <main>
        <div class="container">
            <br>
            <br>
            <br>
            <br>
            <div class="form">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-control">
                        <h1>Settings</h1>
                        <p>Enter your current password and new password then save.</p>
                        <div class="message">
                            <span>
                                <?php
                                if (!empty($error)) {
                                    echo '<p style="color: red;">' . $error . '</p>';
                                } elseif (!empty($success)) {
                                    echo '<p style="color: green;">' . $success . '</p>';
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="current_password">Current Password:</label>
                        <div class="password-container">
                            <input type="password" id="current_password" name="current_password" placeholder="Enter Current Password" required>
                            <i class="fas fa-eye-slash" id="toggleCurrentPassword"></i>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="new_password">New Password:</label>
                        <div class="password-container">
                            <input type="password" id="new_password" name="new_password" placeholder="Enter New Password"  required>
                            <i class="fas fa-eye-slash" id="toggleNewPassword"></i>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="confirm_new_password">Confirm New Password:</label>
                        <div class="password-container">
                            <input type="password" id="confirm_new_password" name="confirm_new_password" placeholder="Confirm New Password" required>
                            <i class="fas fa-eye-slash" id="toggleConfirmPassword"></i>
                        </div>
                    </div>
                    <div class="form-control">
                        <button class="login-btn" type="submit">Change Password</button>
                    </div>
                    <div class="form-control">
                        <p class="p-go-to-site back-link"><a class="go-to-site" href="../"><i class="fa-solid fa-arrow-left-long"></i> Go to Dashboard</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const togglePassword = document.querySelector("#toggleCurrentPassword");
        const passwordInput = document.querySelector("#current_password");

        togglePassword.addEventListener("click", function () {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    </script>
    <script>
        const toggleNewPassword = document.querySelector("#toggleNewPassword");
        const newpasswordInput = document.querySelector("#new_password");

        toggleNewPassword.addEventListener("click", function () {
            const type = newpasswordInput.getAttribute("type") === "password" ? "text" : "password";
            newpasswordInput.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    </script>
    <script>
        const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
        const ConfirmpasswordInput = document.querySelector("#confirm_new_password");

        toggleConfirmPassword.addEventListener("click", function () {
            const type = ConfirmpasswordInput.getAttribute("type") === "password" ? "text" : "password";
            ConfirmpasswordInput.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    </script>
</body>
</html>
