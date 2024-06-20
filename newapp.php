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

    }


    if(isset($_POST['bookappt'])){
        $appointment_date = $_POST['appointment_date'];
        $time = $_POST['appointment_time'];
        $last_name = $_POST['last_namez'];
        $first_name = $_POST['first_namez'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $contact_num = $_POST['contact_num'];
        $address = $_POST['address'];
        $purpose = $_POST['purpose'];
        $userId = $_GET['id'];
        $appointment_status = 'Pending';

        $sql2 = $konek->query("SELECT `appointment_date`, `time` FROM patients WHERE `appointment_date` = '$appointment_date' AND `time` = '$time'");
        $appCheck = $sql2->fetch_assoc();
        $isUnavailable = false;

        if ($sql2->num_rows > 0){
            echo '<script>alert("Date and time are unavailable!");</script>';
        } else{
            $sql1 = $konek->query("INSERT INTO patients (`appointment_date`, `time`, `first_name`, `last_name`, `gender`, `birthdate`, `contact_num`, `address`, `purpose`, `id`) VALUES ('$appointment_date','$time', '$first_name', '$last_name', '$gender', '$birthdate', '$contact_num', '$address', '$purpose', '$userId')");
            header("location: /siafinals/patient.php?user=$username&id=$userId");
        }
    }


    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Appointment</title>
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
                color: #49C3DD;
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
                    <h1>hello, <?php echo $rowname['first_name'] . " ". $rowname['last_name']; ?></h1>
                </div> 
                <div class="title">
                    <h1>EC</h1>
                </div>
                <div class="menu-items">
                    <a style="color: #122C34" href="/siafinals/home.php?user=<?php echo $username; ?>&id=<?php echo $userId?>">Home</a>
                    <a style="color: #122C34;" href="/siafinals/logout.php">Logout</a>
                </div>
                </div>
            </div>
            <h2> New Appointment </h2>
            <form method="POST" class="formarea">
            <label for="appointment_date">Appointment Date</label>
            <input type="date" name="appointment_date" required/>
            <label for="appointment_time">Appointment Time</label>
            <input type="time" name="appointment_time" required/>
            <label for="last_namez">Patient Last Name</label>
            <input type="text" name="last_namez" required/>
            <label for="first_namez">Patient First Name</label>
            <input type="text" name="first_namez" required/>
            <label for="gender">Gender</label>
            <select name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Prefer not to say">Prefer not to say</option>
            </select>
            <label for="birthdate">Patient Birthdate</label>
            <input type="date" name="birthdate" required/>
            <label for="first_name">Contact Number</label>
            <input type="number" name="contact_num" required/>
            <label for="address">Address</label>
            <textarea name="address" rows="4" required></textarea>
            <label for="purpose">Purpose of Appointment</label>
            <textarea name="purpose" rows="4" required></textarea>

            <div class="buttons">
            <input type="submit" name="bookappt" value="Book Appointment" class="bookappt">
            </div>
        </form>
    </div>
    
    </body>
    </html>