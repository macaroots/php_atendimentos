<?php
$servername = "localhost";
$username = "root";
$password = "Admin1@#";
$dbname = "renato";

$nome = $_POST["nome"];
$data = $_POST["data"];
$id_setor = $_POST["id_setor"];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  
  $sql = "INSERT INTO atendimentos (nome, data, id_setor) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $nome);
  $stmt->bindParam(2, $data);
  $stmt->bindParam(3, $id_setor);
  $stmt->execute();
  
  $last_id = $conn->lastInsertId();
  echo "New record created successfully. Last inserted ID is: " . $last_id;
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
