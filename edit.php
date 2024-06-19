<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'ecare';

    // connect to db
    $konek = mysqli_connect($hostname, $username, $password, $dbname);


    if(isset($_GET['user'])){
        $username = $_GET['user'];
        $userId = $_GET['id'];
        $queryname = $konek -> query("SELECT `last_name`, `first_name` FROM `users` where `username` = '$username';");
        $rowname = $queryname->fetch_assoc();
        $kwery = $konek -> query ("SELECT * FROM `patients` where `patient_id` = $userId");
        $deets = $kwery->fetch_assoc();

        if(!isset($_SESSION['first_name']) && !isset($_SESSION['last_name'])){
            $_SESSION['first_name'] = $rowname['first_name'];
            $_SESSION['last_name'] = $rowname['last_name'];
        }
    }

    $first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';
    $last_name = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : '';


    if(isset($_POST['update'])){
        $appointment_status = $_POST['appointment_status'];

        $updatekweri = $konek -> query("UPDATE `patients` SET `appointment_status` = '$appointment_status' WHERE patient_id = $userId");


        if ($updatekweri){
            header("Location: /siafinals/doctor.php?user=$username&id=$userId");
        }
    }
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Appointment</title>
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
                height: 65px;
                background-color: #f6f6f6;
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
                padding-bottom: 2rem;
            }

            h2{
                text-align:center;
                color: greenyellow;
                padding:1rem;
                font-size: 25pt;
            }
            
            .formarea{
                display:flex;
                flex-direction: column;
                gap:1rem;
                background-color: #f6f6f6;
                margin-left: 250px;
                margin-right: 250px;
                padding-top:3rem;
                padding-bottom:2rem;
                padding-left:15rem;
                padding-right:15rem;
                border-radius:10px;
                font-family:arial;
            }

            .formarea select, input{
                border-radius:6px;
                padding: 6px;
                border:1px gray groove;
            }

            .formarea label{
                font-size: 11pt;
                font-weight: bold;
                font-family: Arial;
            }


            .buttons{
            margin-top:1rem;
            display:flex;
            justify-content:center;
            align-self:center;
            }
            
            .bookappt{
            background-color: #49C3DD;
            font-size: 16px;
            /* display:flex;
            justify-content:center;
            align-self:center;*/
            border:none;
            font-weight: bold;
            width:11rem;
            height:3rem;
            }
            .bookappt:hover{
                font-weight: bold;
                background-color: blue;
                color: #f6f6f6;
            }

            .detailsbox{
                background-color: #f6f6f6;
                margin-left:250px;
                margin-right:250px;
                padding: 1rem;
                border-radius: 10px;
                box-shadow: 0 0 5px white;  
            }

            .details{
                display: flex;
                margin:8px;
                margin-left:80px;
                margin-right: 80px;
                padding:1rem;
                justify-content: space-between;
            }

            #update{
                background-color: greenyellow;
                padding:13px;
                font-size: 14px;
                border-radius:10px;
                border: none;
                float: right;
                margin-right: 100px;  
            } 

            #update:hover{
                background-color:gray;
                color: greenyellow;
                font-weight: bold;
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
                    <h1>hello, <?php echo $first_name . " ". $last_name ?></h1>
                </div> 
                <div class="title">
                    <h1>EC</h1>
                </div>
                <div class="menu-items">
                    <a style="color: #122C34" href="/siafinals/doctor.php?user=<?php echo $username; ?>&id=<?php echo $userId?>">Dashboard</a>
                    <a style="color: #122C34;" href="/siafinals/logout.php">Logout</a>
                </div>
                </div>
            </div>

            <h2>Edit Appointment No. <?php echo $deets['patient_id']?> </h2> 

            <div class="detailsbox">
                <div class="details">
                <h3>Appointment Schedule: </h3>
                <p><?php echo $deets['appointment_date'] . ' ' . $deets['time'];?></p>
                </div>
                <div class="details">
                <h3>Name:</h3>
                <p><?php echo $deets['first_name'] . ' ' . $deets['last_name'];?></p>
                </div>
                <div class="details">
                <h3>Contact No.:</h3>
                <p><?php echo $deets['contact_num'];?></p>
                </div>
                <div class="details">
                <h3>Address:</h3>
                <p><?php echo $deets['address'];?></p>
                </div>
                <div class="details">
                <h3>Purpose:</h3>
                <p><?php echo $deets['purpose'];?></p>
                </div>
                <div class="details">
                <h3>Appointment Status:</h3>
                <form method="post">
                <select name="appointment_status" id="appointment_status">
                    <option value="Confirmed" <?php if($deets['appointment_status'] == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                    <option value="Pending" <?php if($deets['appointment_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Cancelled" <?php if($deets['appointment_status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                </select>
            
                </div>
                <button type="submit" name="update" id="update">Update</button>
                </form>
            </div>


            
    </div>
    </body>
    </html>