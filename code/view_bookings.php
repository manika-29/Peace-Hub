<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "peacehub_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

echo "<h2>All Bookings</h2>";
echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Contact</th><th>Category</th><th>Date</th><th>Email</th><th>Location</th><th>Message</th></tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['first_name']} {$row['last_name']}</td>
                <td>{$row['contact']}</td>
                <td>{$row['category']}</td>
                <td>{$row['booking_date']}</td>
                <td>{$row['email']}</td>
                <td>{$row['location']}</td>
                <td>{$row['message']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No bookings found</td></tr>";
}

echo "</table>";

$conn->close();
?>
