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

    // Delete the user from the database
    $sql = "DELETE FROM registrations WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully. <a href='index.php'>Back to Registered Users</a>";
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "User ID not provided.";
}
?>
