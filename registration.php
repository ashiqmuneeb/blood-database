<!DOCTYPE html>
<html>
<head>
    <title>Blood Donation Registration</title>
    <link rel="stylesheet" href="style.css" type="text/css">
       
</head>
<body>
    <h2>Blood Donation Registration</h2>

    <h3>Registration Form</h3>
    <div id="background-image">
    <form method="POST" action="registration.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="blood_group">Blood Group:</label>
        <input type="text" id="blood_group" name="blood_group" required><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required><br><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <input type="submit" name="submit" value="Register">
    </form>
</div>
    <h3>Registered Users</h3>
    <?php
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

    // Handle form submission
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $address = $_POST["address"];
        $blood_group = $_POST["blood_group"];
        $phone_number = $_POST["phone_number"];
        $date = $_POST["date"];

        // Insert registration details into the database
        $sql = "INSERT INTO registrations (name, address, blood_group, phone_number, date) VALUES ('$name', '$address', '$blood_group', '$phone_number', '$date')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


    }

    // Fetch registered users from the database
    $sql = "SELECT * FROM registrations";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Address</th><th>Blood Group</th><th>Phone Number</th><th>Date</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["blood_group"] . "</td>";
            echo "<td>" . $row["phone_number"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No registered users.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
