<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <h2>Edit User</h2>
    <?php
    if (isset($_GET["id"])) {
        $user_id = $_GET["id"];
        
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "blood_donation";

        // Create database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch user details for editing
        $sql = "SELECT * FROM registrations WHERE id = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Create a form to edit user details
            echo '<form method="POST" action="update.php">';
            echo '<input type="hidden" name="user_id" value="' . $user_id . '">';

            echo '<label for="name">Name:</label>';
            echo '<input type="text" id="name" name="name" value="' . $row["name"] . '" required><br><br>';

            echo '<label for="address">Address:</label>';
            echo '<input type="text" id="address" name="address" value="' . $row["address"] . '" required><br><br>';

            echo '<label for="blood_group">Blood_group:</label>';
            echo '<input type="text" id="blood_group" name="blood_group" value="' . $row["blood_group"] . '" required><br><br>';

            echo '<label for="phone_number">phone number:</label>';
            echo '<input type="number" id="phone_number" name="phone_number" value="' . $row["phone_number"] . '" required><br><br>';

            echo '<label for="date">Date:</label>';
            echo '<input type="date" id="date" name="date" value="' . $row["date"] . '" required><br><br>';
            
            echo '<input type="submit" name="update" value="Update">';
            echo '</form>';
        } else {
            echo "User not found.";
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "User ID not provided.";
    }
    ?>
</body>
</html>
