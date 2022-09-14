<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "renato";

$id = $_GET["id"];
$nome = $_POST["nome"];
$data = $_POST["data"];
$id_setor = $_POST["id_setor"];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE atendimentos SET nome=?, data=?, id_setor=? WHERE id=?";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nome);
    $stmt->bindParam(2, $data);
    $stmt->bindParam(3, $id_setor);
    $stmt->bindParam(4, $id);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
