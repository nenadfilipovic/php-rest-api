<?php
// Configure MySQL connection
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Create table in database
$sql = "CREATE TABLE store (
    `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, /* Primary key */
    `item_sku` float, /* Item sku */
    `item_name` varchar(255), /* Item name */
    `item_price` float, /* Item price */
    `item_quantity` float /* Item quantity */
    )";
// Check if table is successfully created
if ($conn->query($sql) === TRUE) {
    echo "Table store created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}
// Close connection after table is made
$conn->close();
?>