<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

require_once("config.php");

$message = [];

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $gender = $_POST['gender'];
    $phn = trim($_POST['phn']);
    $addr = $_POST['addr'];
    $email = trim($_POST['email']);
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $nuid = $_POST['nuid']; // Nurse ID

    if ($_POST['role'] == 'Patient') {
        // Code for patient registration
        $select = mysqli_prepare($conn, "SELECT * FROM user WHERE email = ?");
        mysqli_stmt_bind_param($select, "s", $email);
        mysqli_stmt_execute($select);
        $result = mysqli_stmt_get_result($select);

        if (mysqli_num_rows($result) > 0) {
            $message[] = "User already exists";
        } else {
            if ($pass != $cpass) {
                $message[] = "Confirm Password does not match";
            } else {
                // Insert patient data into the user table
                $stmt = mysqli_prepare($conn, "INSERT INTO user (email, password, role) VALUES (?, ?, 0)");
                mysqli_stmt_bind_param($stmt, "ss", $email, $pass);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    $user_id = mysqli_insert_id($conn); // Get the newly inserted user ID

                    // Insert patient data into the patient table
                    $stmt_patient = mysqli_prepare($conn, "INSERT INTO patient (patient_id, patient_name, patient_gender, patient_phone, patient_address, patient_email, patient_password) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt_patient, "issssss", $user_id, $username, $gender, $phn, $addr, $email, $pass);
                    $result_patient = mysqli_stmt_execute($stmt_patient);

                    echo "Registration successful";
                    // Additional steps for patient registration

                    // Set up user session
                    $_SESSION['user_data'] = [
                        'user_id' => $user_id,
                        'username' => $username,
                        'email' => $email,
                        'role' => 'Patient'
                        // Add any other relevant user data to the session
                    ];

                    mysqli_stmt_close($stmt);
                    mysqli_stmt_close($stmt_patient);
                } else {
                    $message[] = "Registration unsuccessful";

                    mysqli_stmt_close($stmt);
                }
            }
        }
    } elseif ($_POST['role'] == 'Nurse') {
        // Code for nurse registration
        $select = mysqli_prepare($conn, "SELECT * FROM user WHERE email = ?");
        mysqli_stmt_bind_param($select, "s", $email);
        mysqli_stmt_execute($select);
        $result = mysqli_stmt_get_result($select);

        if (mysqli_num_rows($result) > 0) {
            $message[] = "User already exists";
        } else {
            if ($pass != $cpass) {
                $message[] = "Confirm Password does not match";
            } elseif (strlen($nuid) !== 7 || !is_numeric($nuid)) {
                $message[] = "Invalid Nurse ID. Please enter a 7-digit numeric value.";
            } else {
                // Insert nurse data into the nurse table
                $stmt_nurse = mysqli_prepare($conn, "INSERT INTO nurse (nurse_name, nurse_gender, nurse_phone, nurse_address, nurse_email, nurse_password, nurse_uid) VALUES (?, ?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt_nurse, "sssssss", $username, $gender, $phn, $addr, $email, $pass, $nuid);
                $result_nurse = mysqli_stmt_execute($stmt_nurse);

                // Insert nurse user data into the user table
                $stmt_user = mysqli_prepare($conn, "INSERT INTO user (email, password, role) VALUES (?, ?, 2)");
                mysqli_stmt_bind_param($stmt_user, "ss", $email, $pass);
                $result_user = mysqli_stmt_execute($stmt_user);

                if ($result_nurse && $result_user) {
                    $user_id = mysqli_insert_id($conn); // Get the newly inserted user ID

                    echo "Registration successful";
                    // Additional steps for nurse registration

                    // Set up user session
                    $_SESSION['user_data'] = [
                        'user_id' => $user_id,
                        'username' => $username,
                        'email' => $email,
                        'role' => 'Nurse',
                        'nuid' => $nuid
                        // Add any other relevant user data to the session
                    ];

                    mysqli_stmt_close($stmt_nurse);
                    mysqli_stmt_close($stmt_user);
                } else {
                    $message[] = "Registration unsuccessful";

                    mysqli_stmt_close($stmt_nurse);
                    mysqli_stmt_close($stmt_user);
                }
            }
        }
    } else {
        $message[] = "Select the role";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up form</title>
    <link rel="stylesheet" href="signup.css">
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
                    <a class="nav-link" href="login.php">Login</a>
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
                            if ($_SESSION['user_data']) {
                                echo '<a class="drop" href="logout.php">Logout</a>';
                            } else {
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

<form method="post" action="signup.php" enctype="multipart/form-data">
    <div class="contain">
        <div class="row">
            <div class="col">
                <h3 class="title">Create Account</h3>
                <h6 class="txt">Already have an Account? <a href="login.php">Log In</a></h6>
                <?php
                if (isset($message)) {
                    foreach ($message as $message) {
                        echo '<div class="message">' . $message . '</div>';
                    }
                }
                ?>
                <label><b>Username</b></label><br>
                <input type="text" name="username" placeholder="Enter Username" required><br>
                <label><b>Gender</b></label><br>
                <input type="radio" name="gender" value="Male" required> Male
                <input type="radio" name="gender" value="Female" required> Female
                <input type="radio" name="gender" value="Other" required> Other<br>
                <label><b>Phone</b></label><br>
                <input type="text" name="phn" value="+91" size="2" readonly>
                <input type="text" name="phn" placeholder="Phone Number" required><br>
                <label><b>Address</b></label><br>
                <textarea cols="40" rows="2" value="address" name="addr" placeholder="Enter Address" required></textarea><br>
                <label><b>Email</b></label><br>
                <input type="email" id="email" name="email" placeholder="Enter Email" required><br>
                <label><b>Password</b></label><br>
                <input type="password" id="pass" name="pass" placeholder="Enter Password" required><br>
                <label><b>Confirm password</b></label><br>
                <input type="password" id="cpass" name="cpass" placeholder="Confirm password" required><br>
                <label><b>Sign up as</b></label><br>
                <div class="select-tag">
                    <select name="role" id="role" required>
                        <option value="0">Select Role :</option>
                        <option name="patient" value="Patient">Patient</option>
                        <option name="nurse" value="Nurse">Nurse</option>
                    </select>
                </div> 
                <div id="nuid-container" style="display: none;">
                    <label><b>Nurse ID (NUID)</b></label><br>
                    <input type="text" id="nuid" name="nuid" placeholder="Enter Nurse ID (7 digits)" maxlength="7"><br>
                </div>
                <br><input type="submit" value="Submit" name="submit">
            </div>
        </div>
    </div>
</form>
<script>
    document.getElementById('role').addEventListener('change', function() {
        var selectedRole = this.value;
        var nuidContainer = document.getElementById('nuid-container');
        if (selectedRole === 'Nurse') {
            nuidContainer.style.display = 'block';
        } else {
            nuidContainer.style.display = 'none';
        }
    });
</script>
</body>
</html>
