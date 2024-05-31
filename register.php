<?php
session_start();


if (isset($_POST["submit"])) {
    include('config.php');
    $username = $_POST["username"];
    $icno = $_POST["icno"];
    $phoneno = $_POST["phoneno"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $password = sha1($_POST["password"]); // Hash the password using SHA1


    $sqlregpatient = "INSERT INTO `tbl_patients` (`patient_ic`, `patient_email`, `patient_name`, `patient_phone`, `patient_address`, `patient_password`)
                      VALUES (:icno, :email, :username, :phoneno, :address, :password)";
    try {
        $stmt = $conn->prepare($sqlregpatient);
        $stmt->bindParam(':icno', $icno);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':phoneno', $phoneno);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $patientid = $conn->lastInsertId();


        echo "<script>alert('New Patient Added');</script>";
        echo "<script>window.location.href = 'login.php'</script>";


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('31.png'); /* Add your background image here */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            backdrop-filter: blur(5px); /* Optional: Add a blur effect to the background */
        }


        .container {
            background-color: rgba(255, 255, 255, 90); /* Add a white background with some transparency */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }


        h2 {
            color: #333333;
            text-align: center;
            margin-bottom: 30px;
        }


        label {
            color: #333333;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }


        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 12px 12px 40px; /* Added padding-left to make space for the icons */
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }


        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }


        button[type="submit"]:hover {
            background-color: #0056b3;
        }


        .fa-user,
        .fa-envelope,
        .fa-lock,
        .fa-id-card,
        .fa-phone-alt,
        .fa-map-marker-alt {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #999999;
        }


        .form-input {
            position: relative;
            margin-bottom: 20px; /* Added margin to create space between input fields */
        }


        .form-input input {
            padding-left: 40px; /* Added padding to make space for icons */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <div class="form-input">
                <label for="username"><i class="fas fa-user"></i> Name:</label>
                <input type="text" id="username" name="username" required>
            </div>
           
            <div class="form-input">
                <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
           
            <div class="form-input">
                <label for="password"><i class="fas fa-lock"></i> Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
           
            <div class="form-input">
                <label for="icno"><i class="fas fa-id-card"></i> IC Number:</label>
                <input type="text" id="icno" name="icno" required>
            </div>
           
            <div class="form-input">
                <label for="phoneno"><i class="fas fa-phone-alt"></i> Phone Number:</label>
                <input type="text" id="phoneno" name="phoneno" required>
            </div>
           
            <div class="form-input">
                <label for="address"><i class="fas fa-map-marker-alt"></i> Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
           
            <button type="submit" name="submit">Register</button>
        </form>
    </div>
</body>
</html>



