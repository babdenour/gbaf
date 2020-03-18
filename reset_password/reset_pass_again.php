<?php
session_start();
require '../_db.php';

//updape after form
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if ((strlen(htmlspecialchars($_POST['new_password'])) >= 8))
    {
        $new_password = htmlspecialchars($_POST['new_password']);
        $again_password = htmlspecialchars($_POST['again_password']);
        $hpass = password_hash($again_password, PASSWORD_DEFAULT);
        if ($new_password == $again_password)
        {
            $password_update = $pdo->prepare("UPDATE users SET password = ? WHERE user_name = ? AND question = ? AND reponse = ?");
            $password_update->execute([
                $hpass,
                htmlspecialchars($_SESSION['user_name']),
                htmlspecialchars($_SESSION['question']),
                htmlspecialchars($_SESSION['reponse'])
            ]);
        }
        header('Location: ../home.php');
    }
    header('Location: ../index.php');
}
?>