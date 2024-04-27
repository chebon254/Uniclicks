<?php
// Start session
session_start();

// Database connection
include '../connect/database.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../login");
    exit;
}
$success = "";
// Fetch contact form data
$top_offers = "SELECT `id`, `offer`, `monthly_clicks`, `monthly_payouts` FROM `top_offers`";
$result_offers = $conn->query($top_offers);

// Close database connection
$conn->close();
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

    <title>Uniclicks Dashboard</title>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        crossorigin="anonymous" />

</head>

<body>
    <div class="exloretb-form">
        <div class="inner">
            <div class="form-container">
                <button class="cancel-btn-form" id="cancel-btn-form">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <form action="./add_offer.php" method="post">
                    <div class="form-control text-center">
                        <h1>Add an Offer</h1>
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
                        <label>Offer</label>
                        <br>
                        <input type="text" name="offer" placeholder="Enter offer">
                    </div>
                    <div class="form-control">
                        <label>Monthly-clicks</label>
                        <br>
                        <input type="text" name="monthly_clicks" id="monthly-clicks" placeholder="Enter monthly-clicks" required>
                    </div>
                    <div class="form-control">
                        <label>Monthly-payouts</label>
                        <br>
                        <input type="text" name="monthly_payouts" placeholder="Enter monthly-payouts">
                    </div>
                    <div class="form-control">
                        <button class="login-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <main class="dashboard-pg">
        <div class="side-navigation">
            <div class="side-logo">
                <img class="icon" src="../assets/css/favicon/apple-touch-icon-76x76-precomposed.png" alt="Uniclicks">
                <img class="logo" src="../assets/css/img/logo.svg" alt="Uniclicks">
            </div>
            <div class="side-menu">
                <br>
                <br>
                <h3>Quick Menu</h3>
                <button class="dash-menu-btn tab-btn active" onclick="openTab(event, 'dashboardtb')">
                    <div class="contents">
                        <div class="btn-icon">
                            <i class="fa-solid fa-qrcode"></i>
                        </div>
                        <div class="btn-text">
                            Dashboard
                        </div>
                    </div>
                </button>
                <button class="dash-menu-btn tab-btn" onclick="openTab(event, 'exploretb')">
                    <div class="contents">
                        <div class="btn-icon">
                            <i class="fa-regular fa-compass"></i>
                        </div>
                        <div class="btn-text">
                            Explore
                        </div>
                    </div>
                </button>
                <button class="dash-menu-btn tab-btn" onclick="openTab(event, 'accountstb')">
                    <div class="contents">
                        <div class="btn-icon">
                            <i class="fa-regular fa-circle-user"></i>
                        </div>
                        <div class="btn-text">
                            Accounts
                        </div>
                    </div>
                </button>
                <button class="dash-menu-btn tab-btn" onclick="openTab(event, 'contactstb')">
                    <div class="contents">
                        <div class="btn-icon">
                            <i class="fa-regular fa-address-card"></i>
                        </div>
                        <div class="btn-text">
                            Contacts
                        </div>
                    </div>
                </button>
                <button class="dash-menu-btn tab-btn" onclick="openTab(event, 'eventstb')">
                    <div class="contents">
                        <div class="btn-icon">
                        <i class="fa-regular fa-calendar-check"></i>
                        </div>
                        <div class="btn-text">
                            Events
                        </div>
                    </div>
                </button>
                <button class="dash-menu-btn tab-btn" onclick="openTab(event, 'prizestb')">
                    <div class="contents">
                        <div class="btn-icon">
                            <i class="fa-solid fa-trophy"></i>
                        </div>
                        <div class="btn-text">
                            Prizes
                        </div>
                    </div>
                </button>
                <br>
                <br>
                <br>
                <h3>Settings</h3>
                <button class="dash-menu-btn tab-btn" onclick="openTab(event, 'chartstb')">
                    <div class="contents">
                        <div class="btn-icon">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <div class="btn-text">
                            Charts
                        </div>
                    </div>
                </button>
                <button class="dash-menu-btn tab-btn" onclick="openTab(event, 'trendstb')">
                    <div class="contents">
                        <div class="btn-icon">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                        </div>
                        <div class="btn-text">
                            Trends
                        </div>
                    </div>
                </button>
                <button class="dash-menu-btn tab-btn" onclick="openTab(event, 'billingtb')">
                    <div class="contents">
                        <div class="btn-icon">
                            <i class="fa-regular fa-credit-card"></i>
                        </div>
                        <div class="btn-text">
                            Billing
                        </div>
                    </div>
                </button>
                <br>
                <br>
                <button class="side-btn-logout" onclick="location.href='logout.php'">
                    <i class="fa-solid fa-circle-arrow-left"></i> Logout
                </button>
                <br>
                <br>
                <br>
                <div class="side-menu-infocard">
                    <div class="icon">
                        <i class="fa-regular fa-circle-question"></i>
                    </div>
                    <div class="text">
                        <h3>Need Help?</h3>
                        <p>Having trouble using Uniclicks dashboard?</p>
                        <button>Watch Tutorial</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-content">
            <div class="dash-header">
                <div class="header-txt">
                    <h1>Welcome to Uniclicks</h1>
                    <p>Hello, Ido. Welcome back!</p>
                </div>
                <div class="header-account">
                    <div class="nav-item">
                        <a href="#" class="message-icon">
                            <i class="fa fa-envelope"></i>
                            <span class="badge">3</span>
                        </a>
                        <div class="dropdown-menu message-dropdown">
                            <!-- Message previews will be added here dynamically -->
                        </div>
                    </div>

                    <div class="nav-item">
                        <a href="#" class="notification-icon">
                            <i class="fa fa-bell"></i>
                            <span class="badge">2</span>
                        </a>
                        <div class="dropdown-menu notification-dropdown">
                            <!-- Notification items will be added here dynamically -->
                        </div>
                    </div>

                    <div class="nav-item">
                        <a href="#" class="profile-icon">
                            <img src="../assets/css/img/profile.png" alt="Profile Picture">
                        </a>
                        <div class="dropdown-menu profile-dropdown">
                            <a href="./settings">Settings</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dash-tabs">
                <div id="dashboardtb" class="dashboard-tab dash-tab-content" style="display: block;">
                    <div class="dash-campaign">
                        <div class="create">
                            <h1>Create prizes for your visitors</h1>
                            <p>Keep your visitors engaged and retained by creating games and prices <br> to be won</p>
                            <div class="create-btns">
                                <button class="btn-create-prize">Create Prize</button>
                                <button class="btn-view-campaign">View stats</button>
                            </div>
                        </div>
                        <div class="stats">
                            <h1>Stats</h1>
                            <div class="cards">
                                <div class="card">
                                    <h4>Today</h4>
                                    <span>4 users</span>
                                </div>
                                <div class="card">
                                    <h4>This Month</h4>
                                    <span>40 users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="db-summary">
                        <h1>Summary</h1>
                        <div class="db-cards">
                            <div class="card">
                                <div class="card-content">
                                    <h1>6</h1>
                                    <span>Offers</span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content">
                                    <h1>100</h1>
                                    <span>Users</span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content">
                                    <h1>40</h1>
                                    <span>Contacts</span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content">
                                    <h1>6</h1>
                                    <span>Prizes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="exploretb" class="explore-tab dash-tab-content">
                    <div class="add-offer">
                        <h2>Top Offers</h2>
                        <button id="add-offers-btn"><i class="fa-solid fa-plus"></i> Add New Offer</button>
                    </div>
                    <table class="top-offer-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Offer</th>
                                <th>Monthly clicks</th>
                                <th>Monthly Payouts</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $rowNumber = 1; // Initialize row number
                            while ($row = $result_offers->fetch_assoc()) : ?>
                                <tr>
                                    <td><?php echo $rowNumber++; ?></td> <!-- Increment and display row number -->
                                    <td><?php echo $row['offer']; ?></td>
                                    <td><?php echo number_format($row['monthly_clicks']); ?></td>
                                    <td>$<?php echo number_format($row['monthly_payouts']); ?></td>
                                    <td><button class="offer-delete-btn" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-xmark"></i></button></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div id="accountstb" class="accounts-tab dash-tab-content">
                    <div class="add-offer">
                        <h2>User Accounts</h2>
                        <button id=""><i class="fa-solid fa-plus"></i> Add a new user</button>
                    </div>
                    <table>
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Password</th>
                            <th>Remove</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>johndoe@example.com</td>
                            <td>123-456-7890</td>
                            <td>********</td>
                            <td><i class="far fa-trash-can"></i></td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>janesmith@example.com</td>
                            <td>987-654-3210</td>
                            <td>********</td>
                            <td><i class="far fa-trash-can"></i></td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Michael Johnson</td>
                            <td>michael@example.com</td>
                            <td>555-555-5555</td>
                            <td>********</td>
                            <td><i class="far fa-trash-can"></i></td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Sarah Brown</td>
                            <td>sarah@example.com</td>
                            <td>111-222-3333</td>
                            <td>********</td>
                            <td><i class="far fa-trash-can"></i></td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>David Lee</td>
                            <td>david@example.com</td>
                            <td>444-444-4444</td>
                            <td>********</td>
                            <td><i class="far fa-trash-can"></i></td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Emily Wilson</td>
                            <td>emily@example.com</td>
                            <td>777-777-7777</td>
                            <td>********</td>
                            <td><i class="far fa-trash-can"></i></td>
                          </tr>
                        </tbody>
                      </table>
                      
                </div>
                <div id="contactstb" class="contacts-tab dash-tab-content">
                    <h2>Contact Data</h2>
                    <table>
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Communication</th>
                            <th>ID</th>
                            <th>Message</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>johndoe@example.com</td>
                            <td>ABC Company</td>
                            <td>WhatsApp</td>
                            <td>1234567890</td>
                            <td>Lorem ipsum dolor sit amet</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>janesmith@example.com</td>
                            <td>XYZ Corporation</td>
                            <td>Telegram</td>
                            <td>@janesmith</td>
                            <td>Consectetur adipiscing elit</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Michael Johnson</td>
                            <td>michael@example.com</td>
                            <td>123 Industries</td>
                            <td>Email</td>
                            <td>michael@example.com</td>
                            <td>Sed do eiusmod tempor incididunt</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Sarah Brown</td>
                            <td>sarah@example.com</td>
                            <td>Smith & Co.</td>
                            <td>Skype</td>
                            <td>sarah_brown</td>
                            <td>Ut labore et dolore magna aliqua</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>David Lee</td>
                            <td>david@example.com</td>
                            <td>Lee Enterprises</td>
                            <td>WhatsApp</td>
                            <td>0987654321</td>
                            <td>Ut enim ad minim veniam</td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Emily Wilson</td>
                            <td>emily@example.com</td>
                            <td>Wilson Group</td>
                            <td>Email</td>
                            <td>emily@example.com</td>
                            <td>Quis nostrud exercitation ullamco</td>
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>James Taylor</td>
                            <td>james@example.com</td>
                            <td>Taylor Corporation</td>
                            <td>Telegram</td>
                            <td>@jamestaylor</td>
                            <td>Laboris nisi ut aliquip ex ea commodo</td>
                          </tr>
                          <tr>
                            <td>8</td>
                            <td>Emma Clark</td>
                            <td>emma@example.com</td>
                            <td>Clark Industries</td>
                            <td>Skype</td>
                            <td>emma_clark</td>
                            <td>Duis aute irure dolor in reprehenderit</td>
                          </tr>
                          <tr>
                            <td>9</td>
                            <td>Daniel Brown</td>
                            <td>daniel@example.com</td>
                            <td>Brown Enterprises</td>
                            <td>Email</td>
                            <td>daniel@example.com</td>
                            <td>Excepteur sint occaecat cupidatat non proident</td>
                          </tr>
                          <tr>
                            <td>10</td>
                            <td>Lisa Miller</td>
                            <td>lisa@example.com</td>
                            <td>Miller Group</td>
                            <td>WhatsApp</td>
                            <td>5678901234</td>
                            <td>Sunt in culpa qui officia deserunt</td>
                          </tr>
                        </tbody>
                      </table>
                      
                </div>
                <div id="eventstb" class="events-tab dash-tab-content">
                    <div class="add-offer">
                        <h2>Events</h2>
                        <button id=""><i class="fa-solid fa-plus"></i> Add a new event</button>
                    </div>
                    <table>
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Communication</th>
                            <th>ID</th>
                            <th>Message</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>johndoe@example.com</td>
                            <td>ABC Company</td>
                            <td>WhatsApp</td>
                            <td>1234567890</td>
                            <td>Lorem ipsum dolor sit amet</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>janesmith@example.com</td>
                            <td>XYZ Corporation</td>
                            <td>Telegram</td>
                            <td>@janesmith</td>
                            <td>Consectetur adipiscing elit</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Michael Johnson</td>
                            <td>michael@example.com</td>
                            <td>123 Industries</td>
                            <td>Email</td>
                            <td>michael@example.com</td>
                            <td>Sed do eiusmod tempor incididunt</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Sarah Brown</td>
                            <td>sarah@example.com</td>
                            <td>Smith & Co.</td>
                            <td>Skype</td>
                            <td>sarah_brown</td>
                            <td>Ut labore et dolore magna aliqua</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>David Lee</td>
                            <td>david@example.com</td>
                            <td>Lee Enterprises</td>
                            <td>WhatsApp</td>
                            <td>0987654321</td>
                            <td>Ut enim ad minim veniam</td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Emily Wilson</td>
                            <td>emily@example.com</td>
                            <td>Wilson Group</td>
                            <td>Email</td>
                            <td>emily@example.com</td>
                            <td>Quis nostrud exercitation ullamco</td>
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>James Taylor</td>
                            <td>james@example.com</td>
                            <td>Taylor Corporation</td>
                            <td>Telegram</td>
                            <td>@jamestaylor</td>
                            <td>Laboris nisi ut aliquip ex ea commodo</td>
                          </tr>
                          <tr>
                            <td>8</td>
                            <td>Emma Clark</td>
                            <td>emma@example.com</td>
                            <td>Clark Industries</td>
                            <td>Skype</td>
                            <td>emma_clark</td>
                            <td>Duis aute irure dolor in reprehenderit</td>
                          </tr>
                          <tr>
                            <td>9</td>
                            <td>Daniel Brown</td>
                            <td>daniel@example.com</td>
                            <td>Brown Enterprises</td>
                            <td>Email</td>
                            <td>daniel@example.com</td>
                            <td>Excepteur sint occaecat cupidatat non proident</td>
                          </tr>
                          <tr>
                            <td>10</td>
                            <td>Lisa Miller</td>
                            <td>lisa@example.com</td>
                            <td>Miller Group</td>
                            <td>WhatsApp</td>
                            <td>5678901234</td>
                            <td>Sunt in culpa qui officia deserunt</td>
                          </tr>
                        </tbody>
                      </table>
                      
                </div>
                <div id="prizestb" class="prizes-tab dash-tab-content">
                    <div class="prizestb-form">
                        <div class="inner">
                            <div class="form-container">
                                <button class="cancel-btn-form" id="prizestbcancel-btn-form">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <form action="">
                                    <div class="form-control text-center">
                                        <h1>Add a prize</h1>
                                        <div class="message">
                                            <p id="errorMessage">Error</p>
                                        </div>
                                    </div>
                                    <div class="form-control">
                                        <label>Name</label>
                                        <br>
                                        <input type="text" name="prize" placeholder="Enter name">
                                    </div>
                                    <div class="form-control">
                                        <label>Price</label>
                                        <br>
                                        <input type="text" name="price" placeholder="Enter price">
                                    </div>
                                    <div class="form-control">
                                        <label>Probability out of 5</label>
                                        <br>
                                        <input type="number" name="price" placeholder="Enter probability">
                                    </div>
                                    <div class="form-control">
                                        <button class="login-btn" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="add-offer">
                        <h2>Prizes</h2>
                        <button id="prizestb-add-prize-btn"><i class="fa-solid fa-plus"></i> Add a new prize</button>
                    </div>
                    <table>
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Prize Won</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>johndoe@example.com</td>
                            <td>Gold</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>janesmith@example.com</td>
                            <td>Slider</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Michael Johnson</td>
                            <td>michael@example.com</td>
                            <td>Gold</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Sarah Brown</td>
                            <td>sarah@example.com</td>
                            <td>Diamond</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>David Lee</td>
                            <td>david@example.com</td>
                            <td>Slider</td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Emily Wilson</td>
                            <td>emily@example.com</td>
                            <td>Gold</td>
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>Lisa Miller</td>
                            <td>lisa@example.com</td>
                            <td>Diamond</td>
                          </tr>
                        </tbody>
                      </table>
                      
                </div>
                <div id="chartstb" class="charts-tab dash-tab-content">
                    <h1>Charts Coming Soon</h1>
                </div>
                <div id="trendstb" class="trends-tab dash-tab-content">
                    <h1>Trends Coming Soon</h1>
                </div>
                <div id="billingtb" class="billing-tab dash-tab-content">
                    <h1>Billing Coming Soon</h1>
                </div>
            </div>
        </div>
    </main>
    <!-- == Scripts == -->
    <script src="../assets/js/script.js" defer></script>
    <script>
        document.querySelectorAll('.offer-delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const offerId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this offer?')) {
                    fetch('./delete_offer.php?id=' + offerId, { method: 'POST' })
                        .then(response => {
                            if (response.ok) {
                                // Refresh the page or update the table as needed
                                location.reload(); // For example, refresh the page
                            } else {
                                console.error('Failed to delete offer');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>

</body>

</html>