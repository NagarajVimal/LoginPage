<?php
session_start(); // Start a session to store user data

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect input values from the form
    $uname = $_POST['uname'];
    $pswrd = $_POST['pswrd'];

    if (!empty($uname) && !empty($pswrd)) {
        // Database credentials
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "visual1";  // Database name

        // Create connection
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        // Check for connection error
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to fetch the user based on username
        $SELECT = "SELECT uname, pswrd FROM users WHERE uname = ? LIMIT 1";
        $stmt = $conn->prepare($SELECT);

        if ($stmt === false) {
            die("Prepare statement failed: " . $conn->error); // Debugging output
        }

        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $stmt->store_result();

        // Check if the username exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($stored_uname, $stored_pswrd);
            $stmt->fetch();

            // Check if the passwords match
            if ($pswrd === $stored_pswrd) {
                // Correct login, set session variable and redirect to index.html
                $_SESSION['uname'] = $stored_uname;
                header("Location: Main.html?greeting=" . urlencode("Hello, $stored_uname"));
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No account found with that username.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Both fields are required.";
    }
}
?>
