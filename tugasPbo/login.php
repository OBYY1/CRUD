<?php
session_start();

// Fungsi untuk memeriksa apakah pengguna sudah login
function isLoggedIn() {
    return isset($_SESSION['username']);
}

// Jika pengguna sudah login, arahkan ke halaman selanjutnya
if (isLoggedIn()) {
    header("Location: dhasboard.php");
    exit();
}

// Jika formulir login dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari formulir
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Melakukan koneksi ke database (disarankan menggunakan PDO atau mysqli)
    $mysqli = new mysqli("localhost", "root", "", "test");

    // Mengecek koneksi
    if ($mysqli->connect_error) {
        die("Koneksi ke database gagal: " . $mysqli->connect_error);
    }

    // Mengecek kredensial
    $query = "SELECT * FROM user WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Kredensial valid, set session dan arahkan ke halaman selanjutnya
            $_SESSION['username'] = $username;
            header("Location: dhasboard.php");
            exit();
        } else {
            // Kredensial tidak valid
            $error_message = "Username atau password salah.";
        }
    } else {
        // Pengguna tidak ditemukan
        $error_message = "Username atau password salah.";
    }

    // Tutup koneksi
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Silakan Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
        <form action="regist.php"class="btn btn-primary"><button><a href="regist.php"class=btn>daftar</a></button>
        </form>
    </form>
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
</body>
</html>

