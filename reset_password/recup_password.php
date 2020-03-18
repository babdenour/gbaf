<?php
session_start();
require '../_db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    //fetch of the username
    $user_name_verif = $pdo->prepare("SELECT user_name FROM users WHERE user_name = ?");
    $user_name_verif->execute([htmlspecialchars($_POST['user_name'])]);
    $u_n_v = $user_name_verif->fetch();
    $_SESSION['user_name'] = $u_n_v['user_name'];
    $user_name_verif->closeCursor();
    
    if ($u_n_v)
    {
        //fetch question and response
        $q_r_verif = $pdo->prepare("SELECT question, reponse FROM users WHERE user_name = ?");
        $q_r_verif->execute([$_SESSION['user_name']]);
        $q_r = $q_r_verif->fetch();
        $_SESSION['question'] = $q_r['question'];
        $_SESSION['reponse'] = $q_r['reponse'];
        $q_r_verif->closeCursor();
    ?>
        <form class="" name="q_r_form" method="POST" action="./recup_reponse.php">
            <label for="question"><b>Question secrète : "<?=$_SESSION['question']?>"</b></br></label>
            <input type="text" placeholder="Entrer votre reponse secrète" name="reponse" required></br>
            <button type="submit">Validation</button>
        </form>
    <?php 
    }
    else
    {
        header('Location: ./recup_password.php');
    }
}
else
{
?>
    <form class="" method="POST" action="./recup_password.php">
        <label for="username"><b>Pseudo</b></label>
        <input type="text" placeholder="Entrer votre Pseudo" name="user_name" required>
        <button type="submit">Validation</button>
    </form>
<?php
}
?>