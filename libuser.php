<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Books</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f4f4;
    }

    .container {
      text-align: center;
    }

    input[type="text"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
      display: none; /* Initially hide the table */
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Search Books</h1>
    <form method="POST" action="">
      <input type="text" name="searchInput" id="searchInput" placeholder="Search by Title, Author, or Publish Date">
      <button type="submit">Search</button>
    </form>

    <!-- Display Database Values -->
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

    // Handle search request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $searchQuery = mysqli_real_escape_string($conn, $_POST["searchInput"]);
        $sql = "SELECT * FROM books WHERE title LIKE '%$searchQuery%' OR author LIKE '%$searchQuery%' OR publish_date LIKE '%$searchQuery%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table id='resultTable'> <!-- Added an id to the table for easier manipulation -->
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
            echo "<script>document.getElementById('resultTable').style.display = 'table';</script>"; // Display the table after search
        } else {
            echo "0 results";
        }
    }

    // Close connection
    $conn->close();
    ?>
  </div>
</body>
</html>
