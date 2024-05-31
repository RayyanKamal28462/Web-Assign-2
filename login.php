<?php
session_start();
include('config.php');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']); // Hash the entered password using SHA1

    $stmt = $conn->prepare("SELECT * FROM `tbl_patients` WHERE `patient_name` = :username AND `patient_password` = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Login Form</title>
    <style>
        body {
            background-image: url('31.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            backdrop-filter: blur(5px);
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Use rgba for opacity */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px; /* Reduced margin */
            max-width: 600px;
            width: 100%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            animation: slideIn 1s forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-container {
            padding: 20px;
            background-color: white;
            width: 100%;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center; /* Center the form */
        }

        label {
            color: #333;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%; /* Adjust width */
            padding: 12px; /* Increase padding for better spacing */
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Include padding and border in the width calculation */
        }

        button[type="submit"] {
            width: 100%; /* Adjust width */
            padding: 12px; /* Increase padding for better spacing */
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .register-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        .register-btn:hover {
            text-decoration: underline;
        }

        .form-logo {
            display: block;
            margin: 0 auto 20px auto;
            max-width: 170px;
        }

        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        @media (max-width: 600px) {
            .container {
                margin: 10px; /* Reduced margin */
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Reduced shadow for smaller screens */
            }

            input[type="text"],
            input[type="password"],
            button[type="submit"] {
                font-size: 14px; /* Reduced font size */
                padding: 10px; /* Reduced padding */
            }

            .form-logo {
                max-width: 120px; /* Reduced logo size */
            }

            .form-container {
                padding: 15px; /* Reduced padding */
            }
        }
    </style>
</head>
<body>

    <div class="content w3-animate-left">
        <div class="container">
                <img src="logo.png" alt="Shio Clinic Logo" class="form-logo">
                <h2 class="w3-center">Login</h2>
                <form name="loginForm" class="w3-container" action="login.php" method="post">
                    <p>
                        <label for="idusername">Username</label>
                        <input class="w3-input w3-border w3-round" name="username" type="text" id="idusername" required>
                    </p>
                    <p>
                        <label for="idpass">Password</label>
                        <input class="w3-input w3-border w3-round" name="password" type="password" id="idpass" required>
                    </p>
                    <p>
                        <label for="idremember">Remember Me</label>
                        <input class="w3-check" type="checkbox" id="idremember">
                    </p>
                    <p>
                        <button class="w3-btn w3-blue w3-round" type="submit" name="submit">Login</button>
                    </p>
                    <p>
                        <a class="register-btn" href="register.php">Register</a>
                    </p>
                </form>
        </div>
    </div>
</body>
</html>
