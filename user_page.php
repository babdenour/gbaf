<?php
session_start();
require '_db.php';

if (!isset($_SESSION['user_is_connected']) || !$_SESSION['user_is_connected'])
{
    header('Location: ./index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //verif of user_name disponobility
    $user_name_verif = $pdo->prepare("SELECT COUNT(*) FROM users WHERE user_name = ? AND user_id <> ?");
    $user_name_verif->execute([
        htmlentities($_POST['user_name']),
        $_SESSION['user_id']
    ]);
    $nbr_u_n_v = $user_name_verif->fetch();
    $user_name_verif->closeCursor();
   
    //verif global
    if (($nbr_u_n_v[0] > 0) || ($_POST['user_name'] != '') && (strlen(htmlentities($_POST['user_name'])) < 4) || ($_POST['password'] != '') && (strlen(htmlentities($_POST['password'])) < 8))
    {
        if ($nbr_u_n_v[0] > 0)
        {
        ?>
        <script>
            alert('Pseudo indisponible');
            document.location.replace("./user_page.php");
        </script>
        <?php
        }
        if (($_POST['user_name'] != '') && (strlen(htmlentities($_POST['user_name'])) < 4)){
            ?>
            <script>
                alert('Le pseudo ne contient pas au minimum 4 caractères');
                document.location.replace("./user_page.php");
            </script>
            <?php
        }
        if (($_POST['password'] != '') && (strlen(htmlentities($_POST['password'])) < 8)){
            ?>
            <script>
                alert('Le mot de passe ne contient pas au minimum 8 caractères');
                document.location.replace("./user_page.php");
            </script>
            <?php
        }
    }//end verif global

    else
    {
        //update sql champs form
        $hpwd = htmlentities($_POST['password']);
        $hpassword = password_hash($hpwd, PASSWORD_DEFAULT);
        $req = $pdo->prepare("UPDATE users SET nom = ?, prenom = ?, user_name = ?, password = ?, question = ?, reponse = ? WHERE user_id = ?");
        $req->execute([
            htmlentities($_POST['nom']),
            htmlentities($_POST['prenom']),
            htmlentities($_POST['user_name']),
            $hpassword,
            $_POST['question'],
            htmlentities($_POST['reponse']),
            $_SESSION['user_id']
            ]);
        //reset session data
        $_SESSION['nom'] = htmlentities($_POST['nom']);
        $_SESSION['prenom'] = htmlentities($_POST['prenom']);
        $_SESSION['user_name'] = htmlentities($_POST['user_name']);
        $_SESSION['question'] = $_POST['question'];
        $_SESSION['reponse'] = htmlentities($_POST['reponse']);
    }

    
}
//fetch all user_data WHERE user_name == SESSION['user_name']
$req = $pdo->prepare("SELECT nom, prenom, user_name, question, reponse FROM users WHERE user_id = ?");
$req->execute([$_SESSION['user_id']]);
$user_data = $req->fetch();
$req->closeCursor();


?>
<!DOCTYPE html>
<html>
    <head>
        <?php include('./head.php');?>
    </head>
    
    <body>
        <header class="container">
            <?php include('./header.php');?>
        </header>
        <div class="container text-center mt-5">
            <h1>Mon Compte</h1>
            <div class="container text-center mt-5">
                <form name="sign_up_form" method="POST" action="./user_page.php">
                    <div class="form-row" style="padding: 5px">
                        <div class="col-md-4 mb-4">
                            <label for="nom"><b>Nom</b></label>
                            <input class="form-control" type="text" placeholder="Modifier votre Nom ?" value="<?=$user_data['nom']?>" name="nom">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="prenom"><b>Prénom</b></label>
                            <input class="form-control" type="text" placeholder="Modifier votre Prénom ?" value="<?=$user_data['prenom']?>" name="prenom">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="username"><b>Pseudo 4 caractères minimum</b></label>
                            <input class="form-control" type="text" placeholder="Modifier votre Pseudo ?" value="<?=$user_data['user_name']?>" name="user_name">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="password"><b>Mot de passe 8 caractères minimum</b></label>
                            <input class="form-control" type="password" name="password" placeholder="Modifier votre mot de passe ?">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="question"><b>Question secrète</b></label>
                            <select class="form-control" name="question">
                                <option value="<?=$user_data['question']?>">Choisir votre question secrète...</option>
                                <option value="Nom de votre premier jeux vidéo.">Nom de votre premier jeux vidéo.</option>
                                <option value="Nom de jeune fille de votre maman.">Nom de jeune fille de votre maman.</option>
                                <option value="Adresse de votre habitation d'enfance.">Adresse de votre habitation d'enfance.</option>
                                <option value="Equipe de sport favorite.">Equipe de sport favorite.</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="reponse"><b>Réponse secrète</b></label>
                            <input class="form-control" type="text" placeholder="Modifier la réponse à votre question ?" value="<?=$user_data['reponse']?>" name="reponse">
                        </div>
                    </div>
                        <button class="btn btn-primary col-md-3 mb-4" type="submit">Mise à jour</button>
                </form> 
            </div>
        </div>
        <footer>
            <?php include('./footer.php');?>
        </footer>
    <?php include('./script.php');?> </body>
</html>