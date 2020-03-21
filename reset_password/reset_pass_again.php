<?php
session_start();
require '../_db.php';

//updape after form
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $new_password = htmlentities($_POST['new_password']);
    $again_password = htmlentities($_POST['again_password']);
    if ($new_password == $again_password)
    {
        $hpass = password_hash($again_password, PASSWORD_DEFAULT);
        $password_update = $pdo->prepare("UPDATE users SET password = ? WHERE user_name = ? AND question = ? AND reponse = ?");
        $password_update->execute([
            $hpass,
            htmlentities($_SESSION['user_name']),
            $_SESSION['question'],
            $_SESSION['reponse']
        ]);
    }
    session_destroy();
    header('Location: ../index.php');
}
?>