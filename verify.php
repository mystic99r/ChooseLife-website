<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-image: url('images/otp.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            text-align: center;
        }
        .message {
            width: 20%;
            border-radius: 5px;
            padding: 5px;
            text-align: center;
            background-color: red;
            color: white;
            font-size: 18px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
        }
        .c1 {
            margin-left: 500px;
            margin-top: 180px;
        }
        
        .c2 {
            text-align: center;
            width: 500px;
            border: 5px solid black;
        }
        
        h2 {
            background-color: black;
            color: white;
        }
        
        input[type="text"] {
            border: none;
            padding: 8px 15px;
        }
        
        input[type="text"]:hover {
            box-shadow: 10px 10px 10px #000;
        }
        
        input[type="submit"] {
            border: none;
            padding: 7px 20px;
            border-radius: 20px;
            transition: 1s;
            font-weight: 600;
        }
        
        input[type="submit"]:hover {
            background-image: linear-gradient(to left, rgb(88, 187, 240), rgb(236, 137, 232), rgb(140, 140, 251));
            border: none;
            box-shadow: 10px 10px 15px #000;
            color: rgb(255, 255, 255);
            text-shadow: 10px 10px 15px rgb(9, 9, 9);
        }
    </style>


</head>

<body>
<?php
include("config.php");
if(isset($_POST['authenticate']))
{
    $otp1 = $_POST['otp1'];
    $phn = $_SESSION['mobile_no'];
    $verifyOTP = $_SESSION['otp'];
    if($otp1!=null && strlen($otp1) == 6)
    {
        header("location:login.php");
        $select = mysqli_query($conn, "SELECT otp FROM authentication where mobile_no = '$phn'");
        $row = mysqli_fetch_assoc($select);
    }
    else
    {
        $message[] = "Enter valid OTP";
    }
}

?>

    <form method="post" action="verify.php">
        <div class="c1">
            <fieldset class="c2">
                <legend>
                    <h2> Authentication using OTP </h2>
                </legend><br>
                <label><b>Check your email for OTP</b></label><br>
                <input type="text" id="otp1" name="otp1" placeholder="Enter One Time Password"><br><br>
                <input type="submit" value="Submit" name="authenticate">
            </fieldset>
        </div>
        <?php
        if(isset($message))
        {
            foreach ($message as $message) {
                echo '<div class="message">' . $message . '</div>';
            }
        }
        ?>
    </form>
</body>

</html>