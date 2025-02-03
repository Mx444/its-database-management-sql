<?php

require 'user/controllers/user.controller.php';

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $users = $controller->getUsers();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_user'])) {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $controller->createUser($nome, $cognome, $email, $telefono);
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $col = $_POST['col'];
    $value = $_POST['value'];
    $controller->updateUser($id, $col, $value);
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $id = $_POST['id'];
    $controller->deleteUser($id);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione Utente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container {
            margin-top: 50px;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <h1>Registrazione Utente</h1>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="cognome" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="cognome" name="cognome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <button type="submit" class="btn btn-primary" name="create_user">Registra Utente</button>
        </form>
    </div>
    <div class="container">
        <h1>Lista Utenti</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <th scope="row"><?= $user['id'] ?></th>
                        <td><?= $user['nome'] ?></td>
                        <td><?= $user['cognome'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['telefono'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <h1>Aggiorna Utente</h1>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <div class="mb-3">
                <label for="col" class="form-label">Colonna</label>
                <select class="form-select" name="col" required>
                    <option value="nome">Nome</option>
                    <option value="cognome">Cognome</option>
                    <option value="email">Email</option>
                    <option value="telefono">Telefono</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="value" class="form-label">Valore</label>
                <input type="text" class="form-control" id="value" name="value" required>
            </div>
            <button type="submit" class="btn btn-primary" name="update_user">Aggiorna Utente</button>
        </form>
    </div>
    <div class="container">
        <h1>Elimina Utente</h1>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <button type="submit" class="btn btn-primary" name="delete_user">Elimina Utente</button>
        </form>
</body>
    </html>