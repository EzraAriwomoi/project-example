<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STK Push Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            margin-top: 0;
        }
        .form-container input, .form-container button {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Enter Your Details</h2>
        <form action="stkpush.php" method="post">
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" placeholder="Enter amount" required pattern="\d+(\.\d{2})?" title="Please enter a valid amount">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required pattern="\d{10,15}" title="Please enter a valid phone number">
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
