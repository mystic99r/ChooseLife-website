<?php
// Assuming you have already established a database connection

// Retrieve the patient-nurse relationship information from the database
$query = "SELECT p.patient_name, n.nurse_name
          FROM pat_nurse pn
          INNER JOIN patient p ON pn.patient_id = p.patient_id
          INNER JOIN nurse n ON pn.nurse_id = n.nurse_id";

$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error retrieving data from the database: ' . mysqli_error($conn));
}

// Display the patient-nurse relationship information
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Patients Treated by Nurses</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Patients Treated by Nurses</h1>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr><th>Patient Name</th><th>Nurse Name</th></tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['patient_name'] . '</td>';
            echo '<td>' . $row['nurse_name'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No data available';
    }
    ?>
</body>
</html>

<?php
mysqli_close($conn);
?>
