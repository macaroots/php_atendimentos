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
Esta página recebe os dados de cada elemento `input` do formulário enviado pela página anterior. Por que estamos usando o método POST, os dados estão disponíveis através da lista associativa `$_POST`. Para evitar ataques de *SQL Injection*, substitua os valores por `?` e passe os valores usando o método `bindParam()`.
```php
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
```
