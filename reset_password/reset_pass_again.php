<?php
session_start();
require '../_db.php';

//updape after form
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (strlen(htmlentities($_POST['again_password'])) >= 8)
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
        else
        {
        ?>
        <script>
            alert('Entrez un mot de passe identique');
            document.location.replace("./recup_password.php");
        </script>
        <?php
        session_destroy();
        }
    }
    else
    {
    ?>
    <script>
        alert('Le mot de passe ne contient pas au minimum 8 caractères');
        document.location.replace("./recup_password.php");
    </script>
    <?php
    }
}
?>