<?php
session_start();
require '../_db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //fetch of the username
    $user_data = $pdo->prepare("SELECT user_name, question, reponse FROM users WHERE user_name = ?");
    $user_data->execute([htmlentities($_POST['user_name'])]);
    $u_n_v = $user_data->fetch();
    $_SESSION['user_name'] = $u_n_v['user_name'];
    $_SESSION['question'] = $u_n_v['question'];
    $_SESSION['reponse'] = $u_n_v['reponse'];
    $user_data->closeCursor();
    
    if ($u_n_v['user_name'] && ($_POST['question'] == $u_n_v['question']) && ($_POST['reponse'] == $u_n_v['reponse']))
    {
    ?>
        <!DOCTYPE html>
    <html>
        <head>
            <?php include("../head.php"); ?>
        </head>
        <body class="container text-center mt-5">
            <a href="../index.php"><img class="mb-4" src="https://user.oc-static.com/upload/2019/07/15/15631755744257_LOGO_GBAF_ROUGE%20%281%29.png" alt="gbaf" width="72" height="72"></a>
            <form class="form-signin" name="update_password_form" method="POST" action="./reset_pass_again.php">
                <h1 class="h3 mb-3 font-weight-normal">Création nouveau mot de passe</h1>
                <label for="password" class="sr-only">Nouveau mot de passe</label></br>
                <input type="password" placeholder="Entrez mot de passe" id="new_passwprd"name="new_password" class="form-control" required>
                <label for="again_password" class="sr-only">Même mot de passe</label></br>
                <input type="password" placeholder="Entrez à nouveau le mot de passe" id="again_passwprd" name="again_password" class="form-control" required></br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Validation</button>
            </form>
            <footer>
                    <?php include('../footer.php');?>
            </footer>
            <?php include('../script.php');?>
        </body>
    </html>
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
<!DOCTYPE html>
    <html>
        <head>
            <?php include("../head.php"); ?>
        </head>
        <body class="container text-center mt-5">
            <a href="../index.php"><img class="mb-4" src="https://user.oc-static.com/upload/2019/07/15/15631755744257_LOGO_GBAF_ROUGE%20%281%29.png" alt="gbaf" width="72" height="72"></a>
            <form class="form-signin" name="q_r_form" method="POST" action="./recup_password.php">
                <h1 class="h3 mb-3 font-weight-normal">Modification de mot de passe perdu</h1>
                <label for="user_name" class="sr-only">Pseudo</label>
                <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Entrez votre Pseudo" required>
                
                <label for="question"><b></b></label>
                <select class="form-control" name="question" required>
                    <option value="">Choisir votre question secrète...</option>
                    <option value="Nom de votre premier jeux vidéo.">Nom de votre premier jeux vidéo.</option>
                    <option value="Nom de jeune fille de votre maman.">Nom de jeune fille de votre maman.</option>
                    <option value="Adresse de votre habitation d'enfance.">Adresse de votre habitation d'enfance.</option>
                    <option value="Equipe de sport favorite.">Equipe de sport favorite.</option>
                </select>
                </br>
                <label for="reponse" class="sr-only">Reponse</label>
                <input type="password" id="reponse" name="reponse" class="form-control" placeholder="Entrez votre réponse" required>
                </br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Validation</button>
            </form>

            <footer>
                    <?php include('../footer.php');?>
            </footer>
            <?php include('../script.php');?>
        </body>
    </html>
<?php
}
?>