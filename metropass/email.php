<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example Form</title>
</head>
<body>
<form action="#" method="post">

<label for="name">Name:</label>
<input type="text" id="name" name="name" required>

<br>

<label for="age">Age:</label>
<input type="number" id="age" name="age" required>

<br>

<label for="gender">Gender:</label>
<select id="gender" name="gender">
  <option value="male">Male</option>
  <option value="female">Female</option>
</select>

<br>

<label for="favoriteColor">Favorite Color:</label>
<input type="color" id="favoriteColor" name="favoriteColor" value="#ff0000">

<br>

<input type="submit" value="Submit">

</form>

    <?php
session_start();
require 'includes/dbconnection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book'])) {
    $passid = $_SESSION['passid'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE tblticket SET phone = '$phone', email = '$email' WHERE passid = '$passid'";
    $run_query = mysqli_query($conn, $sql);

    if ($run_query) {
        // Build the JSON response
        $jsonResponse = ['status' => true, 'redirect' => 'index.php'];

        // Output the JSON response
        header('Content-Type: application/json');
        echo json_encode($jsonResponse);

        // Stop executing the script
        exit();
    } else {
        echo "Error updating booking.";
    }
}
?>

<script>
// Process the form submission using JavaScript
const form = document.forms.namedItem("book");
form.addEventListener("submit", function(event) {
    event.preventDefault();

    // Rest of the code...

    // After the email is sent, output the success message and redirect to index.php
    if (response.status) {
        Swal.fire({
            icon: 'success',
            title: 'Email Successfully Sent.',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            window.location.replace(response.redirect);
        });
    }
});
</script>
</body>
</html>