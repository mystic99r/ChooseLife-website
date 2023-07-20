<?php
session_start();
// error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE HTML PUBLIC
"-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Nurse</title>
    <link rel="stylesheet" href="nurse.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<section id="nav-bar">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <nav class="navbar navbar-light">
                        <img src="images/choose-life-logo.jpg" width="150" height="80" alt="Choose Life Logo">
                    </nav>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Contact</a>
                        </li>
                        <li class="prof">
                            <div class="dropdown">
                                <div class="dropimg">
                                    <a class="nav-link" href="#profile"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                                </div>
                                <div class="dropdown-content">
                                <?php
                                 if (isset($_SESSION['user_data'])) 
                                {
                                    echo '<a class="drop" href="logout.php">Logout</a>';
                                }
                                else
                                {
                                    echo '<a class="drop" href="login.php">Login</a>';
                                }
                                ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </nav>
        </section>   

        <form method="post" action="nurse.php"><br>
            <div class="cls1">
                <div class="cls2">                    
                    <marquee width="100%" direction="right" height="100%" scrollamount="12" class="blink"><p>~Here you can find Nurses~</p></marquee>
                    <hr style="color: rgb(5, 5, 5);">
                    <label><b>Select Location to find Nurse :</b></label><br>
                    <select name="loc" id="loc" required>
                    <option value="0">Select Location :</option>
                    <option value="Pune">Pune</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Nashik">Nashik</option>
                    <option value="Niphad">Niphad</option>
                    <option value="Baramati">Baramati</option>
                    <option value="Ahmednagar">Ahmednagar</option>
                    <option value="Sambhajinagar">Sambhajinagar</option>
                    <option value="Manmad">Manmad</option>
                    <option value="Sinnar">Sinnar</option>
                    <option value="Nagpur">Nagpur</option>
                </select>
                    <input type="submit" value="Submit" name="submit"><br><br><br><br>
                </div>
            </div>
<?php
require_once("config.php");
if (isset($_POST['submit'])) {
    if (isset($_SESSION['user_data'])) {
            if($_POST['loc']) {
            $select = "SELECT * FROM nurse WHERE nurse_address='" . $_POST['loc'] . "' ORDER BY nurse_name";
            $res = mysqli_query($conn, $select) or die("Query Failed");
            if (mysqli_num_rows($res) > 0) {
                echo '<div class=des><table border=1>';
                echo '<tr>';
                echo '<th>Name</th> <th>Gender</th> <th>Email</th> <th>Address</th> <th>Make Appointment</th>';
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>' . $row['nurse_name'] . '</td>';
                    echo '<td>' . $row['nurse_gender'] . '</td>';
                    echo '<td>' . $row['nurse_email'] . '</td>';
                    echo '<td>' . $row['nurse_address'] . '</td>';
                    echo '<td><div class="des"><a href="tel:' . $row['nurse_phone'] . '"><div class="phone"></div><img src="images/tele.jpg" width="30" height="30"></a></div></td>';
                    echo '</tr>';
                }
            } else {
                $message[] = "No data Found ..";
            }
        }
    }
    else{
        error_reporting(E_ERROR | E_PARSE);
        header("location:login.php");
    }
}

    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message">' . $message . '</div>';
        }
    }
?>        
</form>
</body>

</html>