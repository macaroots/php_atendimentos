<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "renato";

$nome = $_POST["nome"];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  
  $sql = "INSERT INTO setores (nome) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $nome);
  $stmt->execute();
  
  $last_id = $conn->lastInsertId();
  echo "New record created successfully. Last inserted ID is: " . $last_id;
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
