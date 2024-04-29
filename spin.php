<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uniclicks";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch spin wheel data from the database
$sql = "SELECT `spin_prizesTitle`, `Probability`, `BackgroundColor`, `TextColor` FROM `spin_prizes`";
$result = $conn->query($sql);

// Store the fetched data in an array
$spinWheelData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $spinWheelData[] = $row;
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
        console.log(winProbability);
        var randomNumber = 21;

        if ( randomNumber > winProbability) {
            // Show popup for win
            swal({
                title: "Congratulations!",
                text: "You won " + spinWheelData[ai]['spin_prizesTitle'],
                type: "success",
                content: {
                    element: "input",
                    attributes: {
                        placeholder: "Enter your name",
                        type: "text",
                        id: "name-input"
                    }
                },
                html: "<input type='email' id='email-input' placeholder='Enter your email' class='swal-content__input'>" +
                    "<input type='hidden' id='prize-input' value='" + spinWheelData[ai]['spin_prizesTitle'] + "'>",
                confirmButtonText: "Submit",
                preConfirm: function() {
                    return [
                        document.getElementById('name-input').value,
                        document.getElementById('email-input').value,
                        document.getElementById('prize-input').value
                    ]
                }
            }).then(function(result) {
                if (result.dismiss !== swal.DismissReason.cancel) {
                    // Handle form submission for win scenario here
                    // Example:
                    $.ajax({
                        url: 'submit_winner.php',
                        method: 'POST',
                        data: {
                            name: result[0],
                            email: result[1],
                            prizeTitle: result[2]
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
        } else {
            // Show popup for lose
            swal({
                title: "Sorry!",
                text: "Oops! "+ spinWheelData[ai]['spin_prizesTitle'] + "You didn't win. Try again!",
                type: "warning",
                confirmButtonText: "OK",
                closeOnConfirm: true
            })
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

function rand(min, max) {
    return Math.random() * (max - min) + min;
}
</script>

</body>
</html>