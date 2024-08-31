<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

function viewSelfProfile() {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];

    
    $db = new mysqli("localhost", "root", "", "utmadvance");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    
    $sql = "";
    if ($role === 'customer') {
        $sql = "SELECT Username, Email, Address, Contact FROM customer WHERE Username = ?";
    } elseif ($role === 'staff') {
        $sql = "SELECT Username, Email, Address, Contact FROM staff WHERE Username = ?";
    } elseif ($role === 'admin') {
        $sql = "SELECT Username, Email, Address, Contact FROM admin WHERE Username = ?";
    }

    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo "<h2>Your Profile</h2>";
        echo "<table class='w3-table-all w3-card-4'>";
        echo "<tr><th>Username</th><td>" . htmlspecialchars($row['Username']) . "</td></tr>";
        echo "<tr><th>Email</th><td>" . htmlspecialchars($row['Email']) . "</td></tr>";
		echo "<tr><th>Address</th><td>" . htmlspecialchars($row['Address']) . "</td></tr>";
        echo "<tr><th>Contact</th><td>" . htmlspecialchars($row['Contact']) . "</td></tr>";

        echo "</table>";
    } else {
        echo "No profile found.";
    }

    $stmt->close();
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .w3-card-4 {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php viewSelfProfile(); ?>
</body>
</html>
