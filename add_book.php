<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "welcometocit123";
$database = "book"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $title = mysqli_real_escape_string($conn, $_POST["newTitle"]);
    $author = mysqli_real_escape_string($conn, $_POST["newAuthor"]);
    $subject = mysqli_real_escape_string($conn, $_POST["newSubject"]);
    $publishDate = mysqli_real_escape_string($conn, $_POST["newPublishDate"]);

    // Insert data into database
    $sql = "INSERT INTO books (title, author, subject, publish_date) VALUES ('$title', '$author', '$subject', '$publishDate')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch and display existing books
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
    <th>Title</th>
    <th>Author</th>
    <th>Subject</th>
    <th>Publish Date</th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["title"]."</td>
        <td>".$row["author"]."</td>
        <td>".$row["subject"]."</td>
        <td>".$row["publish_date"]."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>