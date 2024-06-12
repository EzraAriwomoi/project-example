<?php
session_start();
include('includes/dbconnection.php');




// Fetch data from the table.
$query = "SELECT ID, CategoryName FROM tblcategory"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Fetch data from the table.
$query = "SELECT ID, DestinationName FROM tbldestination"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$Destinationresult = $stmt->fetchAll(PDO::FETCH_ASSOC);


$conn = mysqli_connect('localhost', 'root', '', 'rpmsdb');
if (!$conn) {
    die("Conection failed: " . mysqli_connect_error());
}

// Fetch data from the 'tbldestination' table for destination dropdown
$queryDestination = "SELECT DestinationName, price FROM tbldestination"; 
$resultDestination = mysqli_query($conn, $queryDestination);

/*if (isset($_POST['availability'])){
    $category = $_POST['category'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $pass = $_POST['pass'];
    $passid = 'Pass-' . rand(1000, 9999);

    $sql = "INSERT INTO tblticket (category, destination,  checkIn, pass, passid) VALUES (?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sssis" , $category, $destination, $date, $pass, $passid);
    mysqli_stmt_execute($stmt);

    header("location: booking.php?available&pass=$passid");
    exit();
} */

if (isset($_POST['availability'])) {
    $category = $_POST['category'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $pass = $_POST['pass'];
    $passid = 'pass-' . rand(1000, 9999);

    // Fetching the price of the selected destination from tbldestination
    $queryDestination = "SELECT price FROM tbldestination WHERE DestinationName = ?";
    $stmtDestination = $dbh->prepare($queryDestination);
    $stmtDestination->execute([$destination]);
    $destinationPrice = $stmtDestination->fetchColumn();

    // Additional fees or taxes calculation
    // Example additional fees, replace with actual calculation if needed
    $totalPrice = $destinationPrice * $pass;

    // Inserting ticket information into tblticket
    $sql = "INSERT INTO tblticket (category, destination, price, checkIn, pass, passid) VALUES (?,?,?,?,?,?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$category, $destination, $totalPrice, $date, $pass, $passid]);

    header("location: booking.php?available&pass=$passid");
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

if (isset($_POST['book'])) {
    $passid = $_GET['pass'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE tblticket SET phone = '$phone', email = '$email' WHERE passid = '$passid'";
    $run_query = mysqli_query($conn, $sql);

    if ($run_query) {
        try {
            $mail = new PHPMailer(true);

            //Server settings
            $mail->isSMTP();
            $mail->Host = 'your_smtp_server';
            $mail->SMTPAuth = true;
            $mail->Username = 'zacky125@gmail.com';
            $mail->Password = '@Zacky123456';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('your_email_address', 'Your Name');
            $mail->addAddress($email, 'User Name');

            // Content
            $mail->Subject = 'Booking Details';
            $mail->Body    = 'Hello,' . "\r\n\r\n" .
                             'Your booking is confirmed!' . "\r\n" .
                             'Details:' . "\r\n" .
                             'Pass ID: ' . $passid . "\r\n" .
                             'Phone: ' . $phone . "\r\n" .
                             'Email: ' . $email;

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        echo '<script language="javascript">';
        echo 'alert("Booking confirmed. An email with your booking details has been sent.");';
        echo 'window.location.replace("index.php");';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo 'alert("Error while saving booking details. Please try again.");';
        echo '</script>';
    }
}


if (isset($_GET["pass"])) {
    $passid = $_GET["pass"];
    $infoquery = "SELECT * FROM tblticket WHERE passid = '$passid'";
    $statement = mysqli_query($conn, $infoquery);
    
    if ($statement) {
        $info = mysqli_fetch_assoc($statement);
        if ($info) {
            // Display the booking information
        } else {
            echo "No booking information found for pass ID: $passid";
        }
}
}

if(isset($_POST['payment'])){
    $phone =  $_GET['phone'];
    $amount = $_GET['price'];

    header('mpesa/');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
</head>
<style>
    *{
        border: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body{
        font-family: 'Poppins', sans-serif;
    }

    main{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-image: url('https://images.unsplash.com/uploads/1413387158190559d80f7/6108b580?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .booking{
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(5px);
    }

    .booking form{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 5px;
        box-shadow: 
                0 10px 20px rgba(0, 0, 0, 0.1),
                0 20px 40px rgba(0, 0, 0, 0.15),
                0 30px 60px rgba(0, 0, 0, 0.2);
    }

    .booking form .form-input{
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .booking form .form-input label{
        font-weight: 500;
        font-size: 14px;
    }

    .booking form .form-input select{
        padding: 0 1rem;
        height: 30px;
        background-color: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .booking form .form-input input[type="number"]{
        padding: 0 1rem;
        height: 30px;
        width: 100px;
        border-radius: 3px;
        border: 1px solid #797979;
        -moz-appearance: textfield;
            appearance: textfield;
            outline: none;
    }

    .booking form .form-input input[type="date"]{
        padding: 0 1rem;
        height: 30px;
        border-radius: 3px;
        border: 1px solid #797979;
    }

    .booking form .form-input input[type="submit"]{
        height: 40px;
        width: 100%;
        background: #ff3d3d;
        font-family: 'Poppins', sans-serif;
        color: #ffffff;
        cursor: pointer;
        font-weight: 600;
        padding: .5rem
    }

    .confirm{
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(5px);
        position: absolute;
    }

    .confirm .img-container{
        width: 300px;
        height: 500px;
        display: flex;
        position: relative;
        align-items: center;
        justify-content: center;
        object-fit: cover;
    }

    .confirm .img-container img{
        width: 100%;
    }

    .confirm .main-form{
        color: wheat;
       /* background-color: burlywood;*/
        position: relative;
        align-self: center;
        width: 450px;
        height: 500px;
       background-image: url("https://images.unsplash.com/photo-1530625625693-b38b404cb1be?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8dHJhaW58ZW58MHwxfDB8fHww");
        padding: 20px;
        box-shadow: 
                0 10px 20px rgba(0, 0, 0, 0.1),
                0 20px 40px rgba(0, 0, 0, 0.15),
                0 30px 60px rgba(0, 0, 0, 0.2);
    }

    .confirm .main-form h1{
        font-size: 24px;
        color:cyan;
        font-weight: 600;
    }

    .confirm .main-form span{
        font-size: 24px;
        color: #2e2e2e;
        font-weight: 600;
        cursor: pointer;
    
    }

    .confirm .main-form form{
        display: flex;
        flex-direction: column;
        gap: 1rem;
        width: 100%;
    }

    .confirm .main-form form .form-input{
        display: flex;
        align-items: start;
        flex-direction: column;
    }

    .confirm .main-form form .form-input input[type="text"]{
        width: 100%;
        outline: none;
        height: 40px;
        border-radius: 3px;
        padding: 0 1rem;
        background-color: #f1f1f1;
        font-family: 'poppins', sans-serif;
        color: #797979;
    }
    .confirm .main-form form .form-group{
        display: flex;
        gap: 1rem;
    }

    .confirm .main-form form .form-group .form-input input{
        width: 100%;
        outline: none;
        height: 40px;
        border-radius: 3px;
        padding: 0 1rem;
        background-color: #e9e9e9;
        font-family: 'poppins', sans-serif;
    }

    .confirm .main-form form .form-input input[type="submit"]{
        height: 40px;
        width: 100%;
        font-weight: 600;
        font-size: 16px;
        text-transform: uppercase;
        font-family: 'Poppins', sans-serif;
        background-color: blue;
        color: #ffffff;
        cursor: pointer;
    }
</style>
<body>
<main>
<?php
if (isset($_GET['available'])) {?>
    
        <!-- ----- booking confirmation ------  -->

        <div class="confirm">

        <div class="main-form">
    <h1>Book your Ticket</h1>
    <form action="" method="post">
        <p style="color: white; font-size: 12px;">Please provide your phone number and email address to proceed</p>
        <div class="form-input">
            <label for="destination">Destination</label>
            <input type="text" required value="<?= $info['destination']; ?>" disabled>
        </div>
        <div class="form-input">
            <label for="price">Price</label>
            <input type="text" required value="<?= $info['price']; ?>" disabled>
        </div>
        <div class="form-input">
            <label for="checkin">Check In</label>
            <input type="text" required value="<?= $info['checkIn']; ?>">
        </div>
        <div class="form-input">
            <label for="passengers">Passengers</label>
            <input type="text" required value="<?= $info['pass']; ?>" disabled>
        </div>
        <div class="form-group">
            <div class="form-input">
                <label for="phone">Phone Number</label>
                <input type="tel" placeholder="0712345678" required name="phone">
            </div>
            <div class="form-input">
                <label for="email">Email Address</label>
                <input type="email" placeholder="example@gmail.com" required name="email">
            </div>
        </div>
        <div class="form-input">
            <input type="submit" value="Book Now" name="book">
        </div>
    </form>
</div>
<?php
    } else{ ?>
?>
    <div class="booking">
        <form action="" method="post">
            <div class="form-input">
                <label for="category">Category</label>
                <select name="category" id="" required>
                    <option value="">--------</option>
                    <?php
                    foreach ($result as $row) {
                        echo "<option value='" . $row['CategoryName'] . "'>" . $row['CategoryName'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-input">
                <label for="destination">Destination</label>
                <select name="destination" id="" required>
                    <option value="">------</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($resultDestination)) {
                        echo "<option value='" . $row['DestinationName'] . "' data - price='" . $row['price'] . "'>" . $row['DestinationName'] . " - $" . $row['price'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-input">
                <label for="date">Check In</label>
                <input type="date" id="destination" min="" max="" required name="date">
            </div>
            <div class="form-input">
                <label for="passengers">Passengers</label>
                <input type="number" maxlength="2" min-length="1" max="15" min="1" name="pass">
            </div>
            <div class="form-input">
                <input type="submit" value="Save booking" name="availability">                
            </div>
        </form>
    </div>
<?php
}
?>
</main>

    <script>
        // Get today's date
    var today = new Date().toISOString().split('T')[0];

    // Set the minimum date to today
    document.getElementById('destination').min = today;

    // Calculate the maximum date (30 days from today)
    var maxDate = new Date();
    maxDate.setDate(maxDate.getDate() + 30);
    var maxDateString = maxDate.toISOString().split('T')[0];

    // Set the maximum date
    document.getElementById('destination').max = maxDateString;

    // Add a click event listener to the span element
    document.getElementById('back').addEventListener('click', function() {
        // Go back to the previous page
        window.history.back();
    });
    </script>
</body>
</html>
