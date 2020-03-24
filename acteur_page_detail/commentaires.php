<?php
session_start();
require '../_db.php';

if (!isset($_SESSION['user_is_connected']) || !$_SESSION['user_is_connected'])
{
    header('Location: ../index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //verif of comment disponobility
    $req = $pdo->prepare("SELECT COUNT(com) FROM articles WHERE acteur_id = ? AND user_id = ?");
    $req->execute([
        $_SESSION['id'],
        $_SESSION['user_id']
    ]);
    $message_verif = $req->fetch();
    $req->closeCursor();
    
    if ($message_verif[0] == 0)
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
        header('Location: ./detail_commentaire.php', TRUE, 503);
    }
}
else 
{
    header('Location: ../index.php');
}
?>