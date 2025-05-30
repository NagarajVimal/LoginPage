<?php
// Database credentials
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "";     // Replace with your database password
$dbname = "visual1"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $email = $conn->real_escape_string($_POST['email']);
    $pswrd = password_hash($_POST['pswrd'], PASSWORD_BCRYPT); // Hash the password

    // Prepare the SQL query
    $sql = "INSERT INTO register(fname, lname, email, pswrd) VALUES ('$fname', '$lname', '$email', '$pswrd')";
// Prepare the SQL query
$sql = "INSERT INTO register(fname, lname, email, pswrd) VALUES ('$fname', '$lname', '$email', '$pswrd')";

// Execute the query and check for success
if ($conn->query($sql) === TRUE) {
    // Redirect to success page
    header("Location: main.html");
    exit();
} else {
    if ($conn->errno === 1062) {
        echo "Error: Email already exists.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
}
// Prepare the SQL query
    $sql = "INSERT INTO register(fname, lname, email, pswrd) VALUES ('$fname', '$lname', '$email', '$pswrd')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        // Redirect to success page
        header("Location: Main.html");
        exit();
    } else {
        if ($conn->errno === 1062) {
            echo "Error: Email already exists.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
