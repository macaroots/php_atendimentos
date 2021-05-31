<?php
$servername = "localhost";
$username = "root";
$password = "Admin1@#";
$dbname = "renato";

try {
    $id = $_GET["id"];

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM atendimentos WHERE id=?");
    $stmt->bindParam(1, $id);
    $stmt->execute();
    
    $setor = $stmt->fetch();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<html>
<body>

    <form action="editar.php?id=<?php echo $id; ?>" method="post">
        Nome: <input type="text" name="nome" value="<?php echo $setor["nome"]; ?>"><br>
        Data/hora: <input type="datetime-local" name="data" value="<?php echo $setor["data"]; ?>"><br>
        Setor: <input type="text" name="id_setor" value="<?php echo $setor["id_setor"]; ?>"><br>
        <input type="submit">
    </form>

</body>
</html>
