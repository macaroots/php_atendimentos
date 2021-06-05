<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "renato";

try {
    $nome = $_POST["nome"];
    $data = $_POST["data"];
    $id_setor = $_POST["id_setor"];

    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $sql = "INSERT INTO atendimentos (nome, data, id_setor) VALUES (?, ?, ?)";
    $consulta = $conexao->prepare($sql);
    $consulta->bindParam(1, $nome);
    $consulta->bindParam(2, $data);
    $consulta->bindParam(3, $id_setor);
    $consulta->execute();

    $ultimo_id = $conexao->lastInsertId();

    echo "Registro inserido com sucesso! ID: " . $ultimo_id;
} catch(PDOException $e) {
    echo "<br>" . $e->getMessage();
}

$conexao = null;
?>
