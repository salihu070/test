<?php
// Database connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "calculation_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $number1 = $_POST['number1'];
    $number2 = $_POST['number2'];

    // Perform calculation
    $result = $number1 + $number2;

    // SQL query to insert data into the database
    $sql = "INSERT INTO calculations (number1, number2, result) VALUES (?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ddd", $number1, $number2, $result);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "<h3>Calculation Successful!</h3>";
        echo "Number 1: " . $number1 . "<br>";
        echo "Number 2: " . $number2 . "<br>";
        echo "Result: " . $result . "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
