<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "renato";

try {
    $nome = $_POST["nome"];
    
    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $sql = "INSERT INTO setores (nome) VALUES (?)";
    $consulta = $conexao->prepare($sql);
    $consulta->bindParam(1, $nome);
    $consulta->execute();

    $ultimo_id = $conexao->lastInsertId();

    echo "Registro inserido com sucesso! ID: " . $ultimo_id;
} catch(PDOException $e) {
    echo "<br>" . $e->getMessage();
}

$conexao = null;
?>
