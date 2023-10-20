<?php
if (isset($_POST["update"])) {
    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    // Add fields for other user information here

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

    // Update user details in the database
    $sql = "UPDATE registrations SET name = '$name', address = '$address' WHERE id = $user_id";
    // Add queries to update other user information here

    if ($conn->query($sql) === TRUE) {
        echo "User information updated successfully. <a href='index.php'>Back to Registered Users</a>";
    } else {
        echo "Error updating user information: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Update request not received.";
}
?>
