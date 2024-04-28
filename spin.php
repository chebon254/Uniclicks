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
$sql = "SELECT spin_prizesTitle, BackgroundColor, TextColor FROM spin_prizes";
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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width" />
    <!-- Required library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>

    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- == Icons == -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        crossorigin="anonymous" />
    <title>Dynamic Spin Wheel</title>
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
          <div class="col-xs-6" align="center">
            <button type="button" id="stop" class="btn btn-info" onclick="stops()">Stop Now!</button>
          </div> 
  </div> 
</div><!-- end container -->
<br>
<center>Developed by <a href="https://shinerweb.com/">Shinerweb</a></center>

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
var speed = 10;
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
    // Increment speed
    if (!isStopped && speed < 3) {
        speed = speed + 1 * 0.1;
    }
    // Decrement Speed
    if (isStopped) {
        if (!lock) {
            lock = true;
            slowDownRand = rand(0.994, 0.998);
        }
        speed = speed > 0.2 ? speed *= slowDownRand : 0;
    }
    // Stopped!
    if (lock && !speed) {
        var ai = Math.floor(((360 - deg - 90) % 360) / sliceDeg); // deg 2 Array Index
        ai = (slices + ai) % slices; // Fix negative index
      
        // Show popup for win or lose
        swal({
            title: "Congratulations!",
            text : "You won " + spinWheelData[ai]['spin_prizesTitle'],
            type: "success",
            confirmButtonText: "OK",
            closeOnConfirm: true
        }).then(function() {
            // Handle form submission for win scenario here
            // You can use AJAX to submit the form data to the server
            // Example:
            // $.ajax({
            //     url: 'submit_winner.php',
            //     method: 'POST',
            //     data: { prizeTitle: spinWheelData[ai]['spin_prizesTitle'], name: $('#name').val(), email: $('#email').val() },
            //     success: function(response) {
            //         console.log(response);
            //     },
            //     error: function(xhr, status, error) {
            //         console.error(error);
            //     }
            // });
        });
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

function stops(){
    isStopped = true;
}

function deg2rad(deg) {
    return deg * Math.PI/180;
}

function rand(min, max) {
    return Math.random() * (max - min) + min;
}
</script>
</body>
</html>