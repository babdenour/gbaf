<?php
session_start();
require '../_db.php';

if (!isset($_SESSION['user_is_connected']) || !$_SESSION['user_is_connected'])
{
    header('Location: ../index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $req = $pdo->prepare("INSERT INTO articles SET com = ?, acteur_id = ?, user_id = ?");
    $req->execute([
        htmlentities($_POST['message']),
        $_SESSION['id'],
        $_SESSION['user_id']
        ]);
    $req->closeCursor();
    header('Location: ./detail_commentaire.php', TRUE, 200);
}
else 
{
    header('Location: ../index.php');
}
?>
