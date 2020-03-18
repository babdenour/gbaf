<?php
session_start();
require '../_db.php';

if ($_POST['reponse'] == $_SESSION['reponse'])
{
?>
    <form name="update_password_form" method="POST" action="./reset_pass_again.php">
        <label for="password"><b>Tapez un nouveau mot de passe :</b></label></br>
        <input type="password" placeholder="Entrez mot de passe" name="new_password" required></br>
        <label for="again_password"><b>Entrez à nouveau le mot de passe :</b></label></br>
        <input type="password" placeholder="Entrez à nouveau le mot de passe" name="again_password" required></br>
        <button type="submit">Validation</button>
    </form>
<?php
}
else
{
    header('Location: ./recup_password.php');
}
?>