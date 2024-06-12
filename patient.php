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

// delete

    if (isset($_GET['delete'])){
        $konek->query ("DELETE FROM `patients` WHERE patients.patient_id = {$_GET['delete']}");
    }

    // if (isset($_GET['delete'])) {
    //     $konek->query("DELETE s, c
    //     FROM schedule s
    //     JOIN classes c ON c.class_id = s.class_id
    //     JOIN instructors i ON c.instructor_id = i.instructor_id
    //     WHERE s.schedule_id = {$_GET['delete']} AND c.instructor_id = 1;");
    // }

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
        position: absolute;
        top: 13px;
        left: 70px;
        font-size: 1rem;
        color: #122C34;
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

    .schedulearea{
        display:flex;
        flex-direction: column;
        align-items:center;
        gap:1rem;
        padding-top: 1rem;
        padding-bottom: 2rem;
    }

    .schedulearea table {
        background-color: #f6f6f6;
        border-radius: 8px;
        border: 2px solid gray;
        box-shadow: 0 0 5px gray;
    }

    .schedulearea table th {
        width: 170px;
        height: 50px;
    }

    .schedulearea table td {
        width: 170px;
        height: 50px;
        text-align: center;
    }

    .schedheader{
        display:flex;
        margin-left: 8rem;
        margin-right: 8rem;
        margin-top:2rem;
        justify-content: center;
        gap: 26rem;
    }

    .schedheader h1{
        font-size: 32px;
        text-align: left;
        color: #f6f6f6;
    }

    .newapptbutton a {
        display: inline-block;
        color: black;
        padding: 11px;
        text-decoration:none;
        text-align: center;
        background-color: #49C3DD;
        border-radius: 10px;
    }

    .newapptbutton a:hover{
        background-color:blue;
        color: #f6f6f6;
    }

    .delete{
        display: inline-block;
        color: black;
        padding: 6px;
        text-decoration:none;
        text-align: center;
        background-color: red;
        border-radius: 10px;
        border:none;
    }

    .delete:hover{
        background-color: gray;
        font-weight: bold;
        color:red;
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
            <div class="patientName">
                <h1>hello, <?php echo $firstname . " ". $lastname ?></h1>
            </div> 
            <div class="title">
                <h1>EC</h1>
            </div>
            <div class="menu-items">
                <!-- <a style="color: #f6f6f6" href="#">Schedule</a> -->
                <a style="color: #122C34" href="/siafinals/home.php?user=<?php echo $username; ?>&id=<?php echo $userId?>">Home</a>
                <a style="color: #122C34" href="/siafinals/logout.php">Logout</a>
            </div>
            </div>
        </div>
            <div class="schedheader">
                <div class="schedh1">
                    <h1>My Appointments</h1>
                </div>
                <div class="newapptbutton">
                    <a href="/siafinals/newapp.php?user=<?php echo $username; ?>&id=<?php echo $userId?>">+ New Appointment</a>
                </div>
            </div>
    <section class="schedulearea">
            <div class="tableheader">
                <table>
                    <th>Patient Name</th>
                    <th>Appointment Date</th>
                    <th>Time</th>
                    <th>Purpose of Appointment</th>
                    <th>Action</th>
                </table>
            </div>

            <div class="schedtable">
                <table>
                    <tbody>
                        <?php
                            foreach ($result as $row) {
                                echo "<tr>";
                                echo "<td style = 'display:none;'>" . $row['patient_id'] . "</td>";
                                echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                                echo "<td>" . $row['appointment_date'] . "</td>";
                                echo "<td>" . $row['time'] . "</td>";
                                echo "<td>" . $row['purpose'] . "</td>";
                                echo "<td> <a href='patient.php?delete=" . $row['patient_id'] . "&user=" . $username . "&id=" . $userId . "' class='delete'>delete</a></td>";
                                echo "</tr>";
                            }
                            ?>
                    </tbody>
                </table>
            </div>
    </section>
</body>
</html>