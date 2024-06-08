<?php
// require 'dashboard.php';

  
  $hostname = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'ecare';

// connect to db
  $konek = mysqli_connect($hostname, $username, $password, $dbname);
// get from db
    $result = $konek->query("SELECT * from `patients` ORDER BY patients.appointment_date, patients.time");

    if(isset($_GET['user'])){
        $username = $_GET['user'];
        $queryname = $konek -> query("SELECT `last_name`, `first_name` FROM `users` where `username` = '$username';");
        $rowname = $queryname->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
</head>
<style>
    *{
        padding: 0;
        margin: 0;
        /* border: 1px black solid; */
    }
    body{
        background-color: #0C5500;
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
    height: 60px;
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
    background: #f6f6f6;
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
    height: 3rem;
    width: 10%;
    transform: translate(-150%);
    display: flex;
    flex-direction: column;
    padding-left:50px;
    transition: transform 0.3s ;
    text-align: left;
    font-size: 1.5rem;
    font-weight: 500;
    background-color: black;
    }

    .title {
    position: absolute;
    top: 13px;
    right: 35px;
    font-size: 1.5rem;
    color: #f6f6f6;
    }
    .studentName {
        position: absolute;
        top: 13px;
        left: 70px;
        font-size: 1rem;
        color: #f6f6f6;
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
        gap:0;
    }

    .schedulearea{
        display:flex;
        flex-direction: column;
        align-items:center;
        gap:2rem;
        padding-top: 1rem;
        padding-bottom: 2rem;
    }

    .schedulearea table {
        background-color: #f6f6f6;
    }

    .schedulearea table th {
        width: 200px;
        height: 50px;
    }

    .schedulearea table td {
        width: 200px;
        height: 50px;
        text-align: center;
    }


    .schedheader h1{
        font-size: 36px;
        text-align: left;
        margin: 1rem;
        margin-left: 8rem;
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
            <div class="studentName">
                <h1>hello, <?php echo $rowname['first_name'] . " " . $rowname['last_name'];?></h1>
            </div> 
            <div class="title">
                <h1>EC</h1>
            </div>
            <div class="menu-items">
                <a style="color: #f6f6f6" href="/siafinals/logout.php">Logout</a>
            </div>
            </div>
        </div>
        <div class="schedheader">
                <h1 style="color: #f6f6f6;">Schedule</h1>
            </div>
        <section class="schedulearea">
            <div class="tableheader">
                <table>
                    <th>Appointment Date</th>
                    <th>Time</th>
                    <th>Patient Name</th>
                    <th>Purpose of Appointment</th>
                    <th>Action</th>
                </table>
            </div>

            <div class="schedtable">
                <table>
                <tbody>
                <?php
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['appointment_date'] . "</td>";
                                echo "<td>" . $row['time'] . "</td>";
                                echo "<td>" . $row['first_name'] ." " . $row['last_name'] . "</td>";
                                echo "<td>" . $row['purpose'] . "</td>";
                                echo "<td> <a href='doctor.php?delete=" . $row['patient_id'] . "&user=" . $username . "' class='delete'>delete</a></td>";
                                echo "</tr>";
                            }
                        ?>
                </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>