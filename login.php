<?php
  
  $hostname = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'ecare';

// connect to db
  $konek = mysqli_connect($hostname, $username, $password, $dbname);
// get from db
  $results = $konek->query("SELECT * FROM `users` WHERE 1")->fetch_all(MYSQLI_ASSOC);

  if (isset($_POST['login'])) {
    $accountType = $_POST['accType'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // query if lahat match
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND account_type = '$accountType'";
    // function na nagsesen query to database using nung konek
    $result = mysqli_query($konek, $query);
    // assign dito value kung may nakuha
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // success
        $userId = $user['id']; // Access the user's ID from the associative array

        if ($accountType == 'patient') {
            header("Location: /siafinals/patient.php?user=$username&id=$userId");
        } else if ($accountType == 'doctor') {
            header("Location: /siafinals/doctor.php?user=$username&id=$userId");
        }
    } else {
        // pag fail
        $error = "Invalid username, password, or account type";
        echo $error;
    }
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCare</title>

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
        .title{
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 3rem;
            padding-bottom: 1rem;
        }
        .loginarea{
            background-color: #f0f0f0;
            width: 450px;
            height: 350px;
            display:flex;
            justify-content:center;
            border-radius: 10px;
            box-shadow: 0 0 5px black;  
        }
        .loginbox{
            display:flex;
            flex-direction:column;
            justify-content:center;
            gap:18px;
        }

        .loginbox input{
            width: 200px;
            margin-left: 10px;
        }

        .loginbox select, input{
            border-radius:6px;
            padding: 8px;
            border:1px gray groove;
        }
        
        .loginbutton{
            display:flex;
            justify-content: center;
        }

        .loginbutton input {
            background-color: #122C34;
            color: #f6f6f6;
            border:none;
            width: 6rem;
            height: 2rem;
        }

        .register-area {
            color: #555;
        }

        .register-area a {
            color: #122C34;
            text-decoration: none;
            font-weight: bold;
        }

        .register-area a:hover {
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
        <div class="loginarea">
            <form method="POST" class="loginbox">
                <h4 style="color: #122C34; text-align:center;">Select account type:</h4>
                <select name="accType" id="accType">
                    <option value="patient">Patient</option>
                    <option value="doctor">Doctor</option>
                </select>
                <div class="input">
                    <input type="text" name="username" placeholder="username"/>
                </div>
                <div class="input">
                <input type="password" name="password" placeholder="password"/>
                </div>
                <div class="loginbutton">
                    <input type="submit" name="login" value="Login"/>
                </div>
                <div class="register-area">
                    <span>Don't have an account?</span>
                    <a href="/siafinals/register.php">Register</a>
                </div>
                    
            </form>
            </div>
        </div>
    </div>

</body>
</html>