<?php

  $hostname = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'ecare';

// connect to db
  $konek = mysqli_connect($hostname, $username, $password, $dbname);

    $result = $konek->query("SELECT * from `users`, `patients` WHERE users.id = patients.id AND patients.id={$_GET['id']} ORDER BY patients.appointment_date, patients.time");

// name persistence?? so malipat-lipat w/o error
    if(isset($_GET['user'])){
        $username = $_GET['user'];
        $userId = $_GET['id'];
        $queryname = $konek -> query("SELECT `last_name`, `first_name` FROM `users` where `username` = '$username';");
        $rowname = $queryname->fetch_assoc();

        if(!isset($_SESSION['first_name']) && !isset($_SESSION['last_name'])){
            $_SESSION['first_name'] = $rowname['first_name'];
            $_SESSION['last_name'] = $rowname['last_name'];
        }
    }

    

    $firstname = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';
    $lastname = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
</head>
<style>
        *{
        padding: 0;
        margin: 0;
        /* border: 1px black solid; */
    }
    body{
        background-color: #122C34;
        font-family: Helvetica;
    }
    .navbar{
        padding-bottom:2rem;

    }

    .nav-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 62px;
    }

    .navbar .nav-container a {
    text-decoration: none;
    color: #0e2431;
    font-weight: 500;
    font-size: 1.2rem;
    padding: 0.7rem;
    }

    .navbar .nav-container a:hover{
        font-weight: bolder;
    }

    .nav-container {
    display: block;
    position: relative;
    height: 65px;
    background-color: #f6f6f6;
    }

    .nav-container .checkbox {
    position: absolute;
    display: block;
    height: 32px;
    width: 32px;
    top: 20px;
    left: 20px;
    z-index: 5;
    opacity: 0;
    cursor: pointer;
    }

    .nav-container .hamburger-lines {
    display: block;
    height: 26px;
    width: 32px;
    position: absolute;
    top: 17px;
    left: 20px;
    z-index: 2;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    }

    .nav-container .hamburger-lines .line {
    display: block;
    height: 4px;
    width: 100%;
    border-radius: 10px;
    background: #122C34;
    }

    .nav-container .hamburger-lines .line1 {
    transform-origin: 0% 0%;
    transition: transform 0.4s ease-in-out;
    }

    .nav-container .hamburger-lines .line2 {
    transition: transform 0.2s ease-in-out;
    }

    .nav-container .hamburger-lines .line3 {
    transform-origin: 0% 100%;
    transition: transform 0.4s ease-in-out;
    }

    .navbar .menu-items {
    padding-top: 60px;
    height: 5.5rem;
    width: 10%;
    transform: translate(-150%);
    display: flex;
    flex-direction: column;
    padding-left:50px;
    transition: transform 0.3s ;
    text-align: left;
    font-size: 1.5rem;
    font-weight: 500;
    background-color: #f6f6f6;
    }

    .title {
    position: absolute;
    top: 9px;
    right: 35px;
    font-size: 1.2rem;
    color: #122C34;
    }

    .patientName {
        /* font-size: 1rem; */
        color: #f6f6f6;
        margin-left: 200px;
        padding-bottom: 1rem;
    }

    .nav-container input[type="checkbox"]:checked ~ .menu-items {
    transform: translateX(0);
    }

    .nav-container input[type="checkbox"]:checked ~ .hamburger-lines .line1 {
    transform: rotate(45deg);
    }

    .nav-container input[type="checkbox"]:checked ~ .hamburger-lines .line2 {
    transform: scaleY(0);
    }

    .nav-container input[type="checkbox"]:checked ~ .hamburger-lines .line3 {
    transform: rotate(-45deg);
    }
    
    
    .parent-container{
        display:flex;
        flex-direction:column;
    }

    .newapptbutton a {
        display: inline-block;
        color: white;
        padding: 11px;
        text-decoration:none;
        text-align: center;
        background-color: #49C3DD;
        border-radius: 10px;
        align-items: center;
    }

    .newapptbutton a:hover{
        background-color:blue;
        color: #f6f6f6;
    }

    .doctor{
        background-color: #f6f6f6;
        margin-left: 200px;
        margin-right: 200px;
        padding: 2rem;
        border-radius: 8px;
        display:flex;
        justify-content: space-between;
        gap: 2rem;
    }

    img{
        width: 300px;
        height: 300px;
    }

    .d2{
        display:flex;
        flex-direction: column;
        gap: 1rem;
    }




</style>
<body>
    <div class="parent-container">
        <div class="navbar">
            <div class="container nav-container">
                <input class="checkbox" type="checkbox"/>
                <div class="hamburger-lines">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
                </div>
            <div class="title">
                <h1>EC</h1>
            </div>
            <div class="menu-items">
                <!-- <a style="color: #f6f6f6" href="#">Schedule</a> -->
                <a style="color: #122C34" href="/siafinals/patient.php?user=<?php echo $username; ?>&id=<?php echo $userId?>">Dashboard</a>
                <a style="color: #122C34" href="/siafinals/logout.php">Logout</a>
            </div>
            </div>
        </div>

            <div class="patientName">
                <h2>hello, <?php echo $firstname . " ". $lastname ?>!</h2>
            </div>    

            <div class="doctor">
                        <div class="d2">
                            <h4>Meet our doctor</h4>
                            <h2 style="color: #49C3DD">Dr. John Smith, M.D.</h2>
                            <p>A trusted healthcare professional dedicated to your well-being. With a wealth of experience and a caring approach, Dr. John Smith is here to provide you with expert medical care and support. Feel confident in the hands of a skilled physician who prioritizes your health and comfort above all else.</p>
                            <div class="newapptbutton">
                            <a href="/siafinals/newapp.php?user=<?php echo $username; ?>&id=<?php echo $userId?>">Book an Appointment</a>
                            </div>
                        </div>
                        <div class="img">
                            <img src="docimh.png" alt="Doctor John">
                        </div>
            </div>

    </div>
</body>
</html>