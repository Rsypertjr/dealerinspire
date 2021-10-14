<?php
$servername = "localhost";
$username = "rlsjr";
$password = "Sypert1234!";
$dbname = "dealerinspire";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Create database
$sql = "CREATE DATABASE dealerinspire";
if ($conn->query($sql) === TRUE) {
  echo "<br>Database created successfully";
} else {
  echo "<br>Error creating database: " . $conn->error;
}

$conn->close();



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE Contacts (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(30) NOT NULL,
  phone VARCHAR(30) ,
  email VARCHAR(50) NOT NULL, 
  message TEXT NOT NULL,
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
  
  if ($conn->query($sql) === TRUE) {
    echo "<br>Table Contacts created successfully";
  } else {
    echo "<br>Error creating table: " . $conn->error;
  }


$conn->close();

?>