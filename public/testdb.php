 <?php
$servername = "db";
$username = "root";
$password = "%(&Mb0,B4v296WN";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?> 
