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

    if (isset($_GET['delete'])){
        $konek->query ("DELETE FROM `patients` WHERE patients.patient_id = {$_GET['delete']}");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
</head>
<style>
    *{
        padding: 0;
        margin: 0;
        /* border: 1px black solid; */
    }
    body{
        background-color: #f6f6f6;
        font-family: Helvetica;
        color: #122C34;
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
    height: 70px;
    background-color: #122C34;
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
    background: #f0f0f0;;
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
    padding-top: 55px;
    height: 4rem;
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
    top: 4px;
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
        gap:1rem;
        padding-top: 1rem;
        padding-bottom: 2rem;
    }

    .schedulearea table {
        background-color:#122C34;
        color: #f6f6f6;
        border-radius: 8px;
        border: 2px solid black;
        box-shadow: 0 0 5px black;
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

    .delete{
        display: inline-block;
        color: black;
        padding: 6px;
        text-decoration:none;
        text-align: center;
        background-color: red;
        border-radius: 10px;
        border:none;
        color: white;
    }

    .delete:hover{
        background-color: gray;
        font-weight: bold;
        color:red;
    }

    .edit{
        display: inline-block;
        color: black;
        padding: 6px;
        text-decoration:none;
        text-align: center;
        background-color: greenyellow;
        border-radius: 10px;
        border:none;
        color: white;
    }

    .edit:hover{
        background-color: gray;
        font-weight: bold;
        color:greenyellow;
    }

    .view{
        display: inline-block;
        color: black;
        padding: 6px;
        text-decoration:none;
        text-align: center;
        background-color: blue;
        border-radius: 10px;
        border:none;
        color: white;
    }

    .view:hover{
        background-color: gray;
        font-weight: bold;
        color:blue;
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
                <a style="color: #122C34" href="/siafinals/logout.php">Logout</a>
            </div>
            </div>
        </div>
        <div class="schedheader">
                <h1 style="color: #122C34;">Your Appointments</h1>
            </div>
        <section class="schedulearea">
            <div class="tableheader">
                <table>
                    <th>Appointment Date</th>
                    <th>Time</th>
                    <th>Patient Name</th>
                    <th>Appointment Status</th>
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
                                echo "<td>" . $row['appointment_status'] . "</td>";
                                echo "<td> 
                                    <a href='view.php?id=" . $row['patient_id'] . "&user=" . $username . "' class='view'>View</a></option>
                                    <a href='edit.php?id=" . $row['patient_id'] . "&user=" . $username . "' class='edit'>Edit</a></option>
                                    <a href='doctor.php?delete=" . $row['patient_id'] . "&user=" . $username . "' class='delete'>Delete</a>
                                   </td>"; 
                            
                                echo "</tr>";
                            }
                        ?>
                </tbody>
                </table>
            </div>
            
        </section>
    </div>

    <!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Modal
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    Modal content
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    <script>
        jQuery(document).ready(function() {
            jQuery('.view').click(function() {
                jQuery('#myModal').modal('show');
            });
        });
   
    </script> -->

</body>
</html>