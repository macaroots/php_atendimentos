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
