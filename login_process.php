<?php

$fields = ['email', 'password'];

// aucune erreur de base
$error = false;
foreach ($fields as $field) {
    if (isset($_POST[$field]) && !empty($_POST[$field])) {
        // on nettoie la valeur
        $$field = htmlspecialchars($_POST[$field]);
    } else {
        // si une des valeurs n'est pas défini ou vide, on passe l'erreur a true
        $error = true;
    }
}

if ($error) {
    exit;
}

// Si aucune erreur

include_once('class/Database.php');

$pdo = Database::connect();

$query = "SELECT * FROM manager WHERE email = :email AND password = :password";
$select = $pdo->prepare($query);
$select->execute([
    ':email' => $email,
    ':password' => hash('sha256', $password)
]);

if($select->rowCount() == 1){
    $user = $select->fetch();
    session_start();
    $_SESSION['connected'] = true;
    $_SESSION['email'] = $user['email'];
    $_SESSION['nom'] = $user['name'];
    header('Location: admin/index.php');
}