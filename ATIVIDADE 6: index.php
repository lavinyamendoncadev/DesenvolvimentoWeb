<?php 
//toda variável em php começa com $
//objetos/CRUDS de sql sempre sao inseridos entre aspas simples
//CRUDs/ações em sql sempre sao inseridos entre aspas duplas
$db = new SQLite3('banco.db');

//$db->exec é um método php para ecexutar um CRUD de SQL, no caso, criar tabela se ela for inexistente.
$db->exec("CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT, email TEXT)");

//$db->query é um método php para ecexutar um CRUD de SQL, no caso, selecionar tudo da tabela users.
$result = $db->query("SELECT * FROM users");

//nesse trecho de PHP executamos o CRUD CREATE E SELECT com métodos PHP exec e query.
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <titlele>CRUD com PHP e SQLite</title>
</head>
<body>
<h1>Lista de usuários</h1>
<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetchArray()):?>
      <tr>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['nome'];?></td>
        <td><?php echo $row['email'];?></td>
        <td>
          <a href="action.php?action=edit&id=<?php echo $row['id'];?>">Editar</a>
          <a href="action.php?action=delete&id=<?php echo $row['id'];?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
          </td>
        </tr>
    <?php endwhile;?>
  </tbody>
</table>
<h2>Adicionar usuário</h2>
  <form action="action.php?action=insert" method="post">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required><br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>
    <button type="submit">Adicionar</button><br>
  </form>
</body>
</html>
