# php_atendimentos
Exemplo de relacionamento 1 para muitos.

Agendar **atendimentos** nos diversos **setores** de uma empresa, anotando: *nome*, *data*, *horário* e *setor*.
```
atendimentos
  id INT PK AI
  nome VARCHAR(45)
  data
  id_setor INT FK (setores.id)
  
setores
  id INT PK AI
  nome VARCHAR(45)
```

## Como utilizar
1. Clone o repositório:
```
git clone https://github.com/macaroots/php_atendimentos.git
```
2. Importe o banco.
```
mysql -u USUARIO -p BANCO < ARQUIVO.SQL
```

## Estrutura dos arquivos
```
|-- index.php (página inicial)
|-- setores/
|   |-- listar.php
|   |-- form.php
|   |-- inserir.php
|   |-- apagar.php
|   |-- form_editar.php
|   |-- editar.php
|-- atendimentos/
|   |-- listar.php
|   |-- form.php
|   |-- inserir.php
|   |-- apagar.php
|   |-- form_editar.php
|   |-- editar.php
```

### index.php
Página inicial com navegação entre as páginas. A propriedade `href` define a página direcionada pelo link.
```html
        <nav>
            <ul>
                <li>
                    Setores
                    <ul>
                        <li><a href="setores/form.php" target="janela">Cadastrar</a></li>
                        <li><a href="setores/listar.php" target="janela">Listar</a></li>
                    </ul>
                </li>
                <li>
                    Atendimentos
                    <ul>
                        <li><a href="atendimentos/form.php" target="janela">Cadastrar</a></li>
                        <li><a href="atendimentos/listar.php" target="janela">Listar</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
```
O `iframe` permite abrir uma janela dentro da página.
```html
	<iframe name="janela" width="100%" height="500"></iframe>
```

### form.php
O PHP é uma linguagem que processa no servidor, um computador diferente do cliente. Para que o usuário possa enviar dados, é necessário um formulário. A propriedade `action` indica a página para onde os dados serão enviados. O HTTP tem dois métodos principais de requisção. GET, para solicitar informações; e POST, para enviar informações. Nesse caso, estamos usando o método POST.
```html
    <form action="inserir.php" method="post">
        Nome: <input type="text" name="nome"><br>
        Data/hora: <input type="datetime-local" name="data"><br>
        Setor: <input type="text" name="id_setor"><br>
        <input type="submit">
    </form>
```

### inserir.php
Esta página recebe os dados de cada elemento `input` do formulário enviado pela página anterior. Uma vez que estamos usando o método POST, os dados estão disponíveis através da lista associativa `$_POST`.
```php
    $nome = $_POST["nome"];
    $data = $_POST["data"];
    $id_setor = $_POST["id_setor"];
```

Abrindo a conexão com o banco de dados. É preciso definir `$servername`, `$dbname`, `$username` e `$password`.
```php
    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
```

Para evitar ataques de *SQL Injection*, substitua os valores por `?`. Depois passe os valores usando o método `bindParam()`. Repare que `$sql` é uma variável com um texto simples contendo o comando SQL a ser executado.
```php
    $sql = "INSERT INTO atendimentos (nome, data, id_setor) VALUES (?, ?, ?)";
    $consulta = $conexao->prepare($sql);
    $consulta->bindParam(1, $nome);
    $consulta->bindParam(2, $data);
    $consulta->bindParam(3, $id_setor);
    $consulta->execute();
```

Recupere o id inserido com o método `lastInsertId()`.
```php
    $ultimo_id = $conexao->lastInsertId();
```

### listar.php
Para começar, perceba que tem código PHP no meio da tabela HTML, o que não é uma boa prática. O ideal seria separar bem a lógica do visual. A tabela HTML sem o PHP ficaria assim:
```php
<table style='border: solid 1px black;'>
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Data</th>
        <th>Setor</th>
        <th>Ações</th>
    </tr>
    <tr>
        <td>1</td>
        <td>André</td>
        <td>01/03/2021</td>
        <td>1</td>
        <td>
            <a href="form_editar.php?id=1">editar</a>
            <a href="apagar.php?id=1">apagar</a>
        </td>
    </tr>
</table>
```

A tabela tem os cabeçalhos de cada coluna com a tag `<th>` e uma com um exemplo de registro. Seguem-se os mesmos passos anteriores: abrir a conexão, preparar a consulta e executar.
```php
    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $consulta = $conn->prepare("SELECT * FROM atendimentos");
    $consulta->execute();
```

Em seguida, o PHP repete a linha da tabela HTML, enquanto houver registro.
```php
<?php
    // ...
    while ($row = $consulta->fetch()) {
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
    // ...
?>
```

Repare como o PHP e o HTML aparecem intercalados. Cada um seguindo sua própria indentação.
