<?php

$db = new SQLite3('banco.db');
$action = isset($_GET['action']) ? $_GET['action'] : '';

if($action == 'insert'){
  $name = $_POST['nome'];
  $email = $_POST['email'];

  $stmt=$db->prepare("INSERT INTO users(nome, email) VALUES (:nome, :email)");

  $stmt->bindValue(':nome', $name, SQLITE3_TEXT);
  $stmt->bindValue(':email', $email, SQLITE3_TEXT);
  $stmt->execute();

  header('Location: index.php');
  exit;
}

if($action == 'edit'){
  $id=$_GET['id'];
  $user=$db->querySingle("SELECT * FROM users WHERE id=$id", true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar usuário</title>
</head>
<body>
  <h1>Editar Usuário</h1>
  <form action="action.php?action=update&id<?php echo $user['id'];?>" method="post">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $user['nome']; ?>" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $user['email'];?>" required><br><br>
    <button type="submit">Atualizar</button>
  </form>
</body>
</html>
<?php
  exit;
}

if($action=='update'){
  $id=$_GET['id'];
  $name=$_POST['nome'];
  $email=$_POST['email'];

  $stmt=$db->prepare("UPDATE users SET nome=:nome, email=:email WHERE id=:id");
  $stmt->bindValue(':nome', $name, SQLITE3_TEXT);
  $stmt->bindValue(':email', $email, SQLITE3_TEXT);
  $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
  $stmt->execute();

  header('Location: index.php');
  exit;
}

if($action == 'delete'){
  $id=$_GET['id'];
  $db->exec("DELETE FROM users WHERE id = $id");

  header('Location: index.php');
  exit;
}
?>

