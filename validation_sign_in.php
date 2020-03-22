<?php
require '_db.php';

//rq->fech()($_POST['user_name'] && $_POST['password'])
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $vpswd = htmlentities($_POST['password']);
    $req = $pdo->prepare("SELECT user_id, user_name, nom, prenom, password FROM users WHERE user_name = ?");
    $req->execute([htmlentities($_POST['user_name'])]);
    $user_data = $req->fetch();
    $req->closeCursor();
    $verifpass = password_verify($vpswd, $user_data['password']);
    
    if (isset($user_data['user_id']) && $verifpass == true)
    {
        session_start();
        // add user data to session id nom prenom
        $_SESSION['user_id'] = $user_data['user_id'];
        $_SESSION['nom'] = $user_data['nom'];
        $_SESSION['prenom'] = $user_data['prenom'];
        $_SESSION['user_name'] = $user_data['user_name'];
        $_SESSION['user_is_connected'] = true;
        //redirection
        header('Location: ./home.php');
    }
    //pop up pb of connexion
    else 
    {
    ?>
    <script>
        alert('Données incohérentes');
        document.location.replace("./index.php");
    </script>
    <?php
    }
}
else 
{
    header('Location: ./index.php');
}
?>