<?php
include './admin/connect/database.php';

// Fetch contact form data
$top_offers = "SELECT `id`, `offer`, `monthly_clicks`, `monthly_payouts` FROM `top_offers`";
$result_offers = $conn->query($top_offers);
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
        <br>
        <br>
        <h1>Spin Wheel</h1>
        <br>
        <br>
        <div class="spin-wheel">
            <button id="spin">Spin</button>
            <span class="spin-wheel-arrow"></span>
            <div class="spin-wheel-container">
                <div class="spin-wheel-one">1</div>
                <div class="spin-wheel-two">2</div>
                <div class="spin-wheel-three">3</div>
                <div class="spin-wheel-four">4</div>
                <div class="spin-wheel-five">5</div>
                <div class="spin-wheel-six">6</div>
                <div class="spin-wheel-seven">7</div>
                <div class="spin-wheel-eight">8</div>
            </div>
        </div>
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
        <br>
        <br>
        <h1>Events</h1>
        <br>
        <br>
        <br>
        <br>
    </div>
    <!-- == Scripts == -->
    <script src="js/script.js" defer></script>
    <script src="assets/js/spin.js"></script>
</body>

</html>