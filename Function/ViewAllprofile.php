<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Profiles</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <h2>All User Profiles</h2>
    <?php
session_start();
require 'config.php';

function viewAllProfiles() {

    $roles = ['customer', 'staff', 'admin'];

    foreach ($roles as $role) {
        echo "<h2>" . ucfirst($role) . " Profiles</h2>";
        $sql = "";

        if ($role === 'customer') {
            $sql = "SELECT Username, Email, Address, Contact FROM $role";
        } else {
            $sql = "SELECT Username, Email, Address FROM $role";
        }

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='w3-table-all w3-card-4'>";
            echo "<tr><th>Username</th><th>Email</th><th>Address</th>";
            echo "<th>Contact</th>";
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
				echo "<td>" . htmlspecialchars($row['Address']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Contact']) . "</td>";

                echo "</tr>";
            }

            echo "</table><br>";
        } else {
            echo "No profiles found in $role.<br>";
        }
    }

    $con->close();
}

viewAllProfiles();
?>
</body>
</html>