<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

// Check if the user is logged in as admin
if (!isset($_SESSION['user_data']) || $_SESSION['user_data']['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

require_once("config.php");

// Query to retrieve patient and nurse information
$query = "SELECT p.patient_name, n.nurse_name
          FROM pat_nur pn
          INNER JOIN patient p ON p.patient_id = pn.patient_id
          INNER JOIN nurse n ON n.nurse_id = pn.nurse_id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
    <!-- Add any additional stylesheets or scripts as needed -->
</head>
<body>

<section id="nav-bar">
    <!-- Add navigation bar HTML code here -->
</section>

<div class="container">
    <h2>Patients and Assigned Nurses</h2>
    <table>
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Nurse Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display patient and nurse information
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['patient_name'] . "</td>";
                echo "<td>" . $row['nurse_name'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
