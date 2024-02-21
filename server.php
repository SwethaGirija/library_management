<?php
// Database credentials
$host = 'localhost'; // Change this to your database host if it's different
$dbname = 'library'; // Change this to your database name
$username = 'root'; // Change this to your database username
$password = 'welcometocit123'; // Change this to your database password

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare an SQL statement to insert data
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    
    // Bind parameters
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    
    // Assign values to parameters
    $username = $_POST['username']; // Assuming you're posting the username and password values from a form
    $password = $_POST['password'];
    
    // Execute the prepared statement
    $stmt->execute();
    
    echo "Record inserted successfully";
} catch (PDOException $e) {
    // Display error message if connection fails
    echo "Connection failed: " . $e->getMessage();
}
?>
