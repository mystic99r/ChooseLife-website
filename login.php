<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

require_once("config.php");

$message = [];

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Check if the login attempt is for admin
    $select_admin = mysqli_prepare($conn, "SELECT * FROM admin WHERE admin_email = ? AND admin_password = ?");
    mysqli_stmt_bind_param($select_admin, "ss", $email, $pass);
    mysqli_stmt_execute($select_admin);
    $result_admin = mysqli_stmt_get_result($select_admin);

    if (mysqli_num_rows($result_admin) > 0) {
        $row_admin = mysqli_fetch_assoc($result_admin);
        $_SESSION['user_data'] = $row_admin;
        
        header('location:admin_dashboard.php');
        exit;
    } else {
        // Check if the login attempt is for nurse
        $select_nurse = mysqli_prepare($conn, "SELECT * FROM nurse WHERE nurse_email = ? AND nurse_password = ?");
        mysqli_stmt_bind_param($select_nurse, "ss", $email, $pass);
        mysqli_stmt_execute($select_nurse);
        $result_nurse = mysqli_stmt_get_result($select_nurse);

        if (mysqli_num_rows($result_nurse) > 0) {
            $row_nurse = mysqli_fetch_assoc($result_nurse);
            $_SESSION['user_data'] = $row_nurse;
            
            header('location: nurse.php');
            exit;
        } else {
            // Check if the login attempt is for patient
            $select_patient = mysqli_prepare($conn, "SELECT * FROM patient WHERE patient_email = ? AND patient_password = ?");
            mysqli_stmt_bind_param($select_patient, "ss", $email, $pass);
            mysqli_stmt_execute($select_patient);
            $result_patient = mysqli_stmt_get_result($select_patient);

            if (mysqli_num_rows($result_patient) > 0) {
                $row_patient = mysqli_fetch_assoc($result_patient);
                $_SESSION['user_data'] = $row_patient;
                
                header('location:nurse.php');
                exit;
            } else {
                $message[] = "Incorrect email or password";
            }
        }
    }

    mysqli_stmt_close($select_admin);
    mysqli_stmt_close($select_nurse);
    mysqli_stmt_close($select_patient);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
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
                    <a class="nav-link" href="nurse.php">Nurses</a>
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

<form action="login.php" method="post">
    <div class="login">
        <div class="l1">
            <div class="l2">
            <?php
                if(isset($message))
                {
                    foreach($message as $message)
                    {
                        echo '<div class="message">' . $message . '</div>';
                    }
                }
            ?>
                <img src="images/person-square.svg" width="50" height="50"><br>
                <label class="title"><b>Email</b></label><br>
                <input type="email" name="email" placeholder="Enter email" required/><br>
                <label class="title"><b>Password</b></label><br>
                <input type="password" name="pass" placeholder="Enter Password" required/><br>
                <input type="submit" value="Login" name="login" /><br>
                <p class="txt">Don't have an Account? <a href="signup.php"><b>Sign Up</b></a></p>
            </div>
        </div>
    </div>
</form>

</body>
</html>
