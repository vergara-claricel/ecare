<?php

    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'ecare';

    $konek = mysqli_connect($hostname, $username, $password, $dbname);

    // after register

    if (isset($_POST['register'])){
        $account_type = $_POST['account_type'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $birthdate = $_POST['birthdate'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $konek ->query("INSERT INTO `users` (`account_type`, `first_name`, `last_name`, `birthdate`, `email_address`, `username`, `password`) VALUES ('$account_type', '$first_name', '$last_name', '$birthdate', '$email', '$username', '$password')");
        header ('location: /siafinals/login.php');
    }else{
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', true);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        *{
        padding: 0;
        margin: 0;
        /* border: 1px black solid; */
        }
        body{
            background-color: #49C3DD;
            font-family: Helvetica;
        }
        .parent-container{
            display: flex;
            flex-direction:column;
            justify-content: center;
            align-items: center;
            padding-bottom: 5rem;
        }
        .formcontainer{
            display:flex;
            flex-direction: column;
            justify-content:center;
            align-items:center;
        }
        .title{
            color: white;
            text-align:center;
            margin-top: 20px;
        }
        .formcontainer{
            background-color: #f0f0f0;
            border-radius: 8px;
            margin-top:1rem;
            padding-left:7rem;
            padding-right:7rem;
            padding-top: 3rem;
            padding-bottom: 4rem;
            color: #122C34;
            box-shadow: 0 0 5px black; 
        }

        .formcontainer h2 {
            margin-bottom: 25px;
        }
        .form-group{
            margin-bottom: 20px;
            position: relative:
        }
        label{
            display:block;
        }
        input, select{
            border-radius:6px;
            width: calc(100%-32px);
            padding: 9px;
            font-size: 16px;
        }
        .buttons{
            display: flex;
            justify-content:center;;
            align-items:center;
            gap: 20px;
        }

        .buttons input:hover{
            background-color:#49C3DD;
        }

        button{
            border: none;
        }

        button:hover{
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="parent-container">
        <div class="title">
            <h1 style="font-size: 60pt">EC</h1>
            <h3 style="font-size: 20pt">easy, e-care</h3>
        </div>
        <div class="formcontainer">
            <h2>Patient Account Registration Form</h2>
            <form id="registrationForm" method="post">
                <div class="form-group">
                    <label for="account_type">I am a:</label>
                    <select name="account_type">
                        <option value="patient" name="patient">patient</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="birthdate">Birthdate:</label>
                    <input type="date" id="birthdate" name="birthdate" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="buttons">
                    <input type="submit" name='register' value="Register">
                    <button type="button" class="clear-button" onclick="clearForm()">Clear All</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function clearForm() {
            document.getElementById("registrationForm").reset();
        }
    </script>
</body>

</html>