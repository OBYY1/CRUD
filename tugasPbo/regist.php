<?php
// Create a database connection
$conn = new mysqli('localhost', 'root', '', 'test');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process registration form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $newUsername = $_POST['newUsername'];
    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT); // Hash the password
    $newEmail = $_POST['newEmail'];

    // Check if the username already exists
    $checkSql = "SELECT username FROM user WHERE username = ?";
    $checkStmt = $conn->prepare($checkSql);

    if ($checkStmt) {
        $checkStmt->bind_param("s", $newUsername);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            echo "Username already exists. Please choose a different username.";
            exit;
        }

        $checkStmt->close();
    } else {
        echo "Error preparing username check SQL statement.";
        exit;
    }

    // Insert user data into the database
    $sql = "INSERT INTO user (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $newUsername, $newPassword, $newEmail);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            header("Location: login.php");
            exit;
        } else {
            echo "Error during registration.";
        }

        $stmt->close();
    } else {
        echo "Error preparing SQL statement.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>regist</title>
</head>
<body>
<h2>Silakan Daftar</h2>
    <form action="regist.php" method="post">

        <label for="newUsername">Username Baru:</label>
        <input type="text" id="newUsername" name="newUsername" required><br><br>

        <label for="newPassword">Password Baru:</label>
        <input type="password" id="newPassword" name="newPassword" required><br><br>
        
        <label for="newEmail">Email Baru:</label>
        <input type="email" id="newEmail" name="newEmail" required><br><br>

        <input type="submit" value="regist">
        <form action="login.php"><button><a href="login.php">login</a></button>
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            // Check if the URL contains a success parameter
            const urlParams = new URLSearchParams(window.location.search);
            const success = urlParams.get('success');

            // If success parameter is present, show the success message
            if (success === 'true') {
                alert("Registration successful!");
            }

            // Handle form submission
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                 event.preventDefault();
                 form.submit();
              });
            });
        </script>
        <style>
body {
font-family: Arial, sans-serif;
background-color: #f2f2f2;
}

h2 {
    text-align: center;
    margin-top: 20px;
}

form {
    background-color: #fff;
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="text"],
input[type="password"],
input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

button{
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}
a{
    color: #fff;
}
button a:hover{
    color: #fff;
}
    </style>
</form>
</body>
</html>