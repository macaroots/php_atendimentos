<table style='border: solid 1px black;'>
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Data</th>
        <th>Setor</th>
        <th>Ações</th>
    </tr>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "renato";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM atendimentos");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['data']; ?></td>
        <td><?php echo $row['id_setor']; ?></td>
        <td>
            <a href="form_editar.php?id=<?php echo $row['id']; ?>">editar</a>
            <a href="apagar.php?id=<?php echo $row['id']; ?>">apagar</a>
        </td>
    </tr>
<?php
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
</table>
