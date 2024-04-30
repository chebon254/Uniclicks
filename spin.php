<?php
include './admin/connect/database.php';

// Fetch spin wheel data from the database
$sql = "SELECT `spin_prizesTitle`, `Probability`, `BackgroundColor`, `TextColor` FROM `spin_prizes`";
$result = $conn->query($sql);

$prizewon_success = "";
$prizewon_error = "";

// Store the fetched data in an array
$spinWheelData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $spinWheelData[] = $row;
    }
}

// Insert winner's data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $prizeTitle = $_POST["prizeTitle"];

    $sql = "INSERT INTO `winners`(`name`, `email`, `prize`) VALUES ('$name', '$email', '$prizeTitle')";

    if ($conn->query($sql) === TRUE) {
        $prizewon_success = "Data inserted successfully";
    } else {
        $prizewon_error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!doctype html>
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
    <!-- Required library -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
	
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body{
            position: relative;
        }
        .popup-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<style>
    .col-xs-12{
        position: relative;
        z-index: 0;
        width: 340px !important;
        height: 340px !important;
        border-radius: 170px;
        border: 10px solid #525252;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
    .spin-wheel-arrow{
        min-height: 20px;
        width: 20px;
        position: absolute;
        top:0;
        left:50%;
        transform: translateX(-50%);
        color:#000000;
        z-index: 10;
        font-size: 28px;
    }

</style>
<div class="popup-container" id="popup-container">
        <div class="popup-card">
            <div id="win-card" style="display: none;">
                <h2>Congratulations!</h2>
                <p>You won <span id="win-prize"></span></p>
                <?php if (!empty($signup_error)) { ?>
                    <div class="message">
                        <p id="errorMessage"><?php echo $prizewon_error; ?></p>
                    </div>
                <?php } else { ?>
                    <div class="message">
                        <p id="successMessage"><?php echo $prizewon_success; ?></p>
                    </div>
                <?php } ?>
                <form id="win-form">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <input type="hidden" id="prize-input" name="prize" value="">
                    <button type="submit" class="btn">Submit</button>
                </form>
            </div>
            <div id="lose-card" style="display: none;">
                <h2>Sorry!</h2>
                <p>Oops! <span id="lose-prize"></span> You didn't win. Try again!</p>
                <button class="btn" onclick="closePopup()">OK</button>
            </div>
        </div>
    </div>
<div class="container">  
  <h4 align="center">Dynamic Spin Wheel</h4>   
  <div class="row">
     <div class="col-xs-12" align="center">
     <span class="spin-wheel-arrow"><i class="fa-solid fa-down-long"></i></span>
             <div id="wheel" style="width: 320px;">
                <canvas id="canvas" width="320" height="320"></canvas>
             </div>
      </div>   
  </div><!--  end row -->
   <div class="row">
          <div class="col-xs-6" align="center">
            <button type="button" class="btn btn-success" onclick="spin()">Spin Now!</button>
          </div>
  </div> 
</div><!-- end container -->
<br>

<script language="JavaScript">
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

setTimeout(function() {
    isStopped = true;
}, 6000);

function deg2rad(deg) {
    return deg * Math.PI/180;
}
        function showWinPopup(prizeTitle) {
            document.getElementById('win-card').style.display = 'block';
            document.getElementById('win-prize').textContent = prizeTitle;
            document.getElementById('prize-input').value = prizeTitle;
            document.getElementById('popup-container').style.display = 'flex';
        }

        function showLosePopup(prizeTitle) {
            document.getElementById('lose-card').style.display = 'block';
            document.getElementById('lose-prize').textContent = prizeTitle;
            document.getElementById('popup-container').style.display = 'flex';
        }
        function closePopup() {
                document.getElementById('popup-container').style.display = 'none';
                document.getElementById('win-card').style.display = 'none';
                document.getElementById('lose-card').style.display = 'none';
            }
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('win-form').addEventListener('submit', function(event) {
                event.preventDefault();
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const prizeTitle = document.getElementById('prize-input').value;

                // Send data to the server using AJAX or fetch
                const formData = new FormData();
                formData.append('name', name);
                formData.append('email', email);
                formData.append('prizeTitle', prizeTitle);

                fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    closePopup();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });

            // ... (existing code) ...
        });
function rand(min, max) {
    return Math.random() * (max - min) + min;
}
</script>

</body>
</html>