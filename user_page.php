<?php
session_start();
require '_db.php';

if (!isset($_SESSION['user_is_connected']) || !$_SESSION['user_is_connected'])
{
    header('Location: ./index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!(strlen(htmlspecialchars($_POST['user_name'])) || strlen(htmlspecialchars($_POST['password'])) <= 4))
    {
        //verif of user_name disponobility
        $user_name_verif = $pdo->prepare("SELECT COUNT(*) FROM users WHERE user_name = ? AND user_id <> ?");
        $user_name_verif->execute([
            htmlspecialchars($_POST['user_name']),
            $_SESSION['user_id']
        ]);
        $nbr_u_n_v = $user_name_verif->fetch();
        $user_name_verif->closeCursor();
        
        if ($nbr_u_n_v[0] > 0)
        {
            echo 'username deja utiliser</br>';
        }
        else
        {
            //update sql champs form
            $hpwd = htmlspecialchars($_POST['password']);
            $hpassword = password_hash($hpwd, PASSWORD_DEFAULT);
            $req = $pdo->prepare("UPDATE users SET nom = ?, prenom = ?, user_name = ?, password = ?, question = ?, reponse = ? WHERE user_id = ?");
            $req->execute([
                htmlspecialchars($_POST['nom']),
                htmlspecialchars($_POST['prenom']),
                htmlspecialchars($_POST['user_name']),
                $hpassword,
                htmlspecialchars($_POST['question']),
                htmlspecialchars($_POST['reponse']),
                $_SESSION['user_id']
                ]);
                
            $_SESSION['nom'] = htmlspecialchars($_POST['nom']);
            $_SESSION['prenom'] = htmlspecialchars($_POST['prenom']);
            $_SESSION['user_name'] = htmlspecialchars($_POST['user_name']);
            $_SESSION['question'] = htmlspecialchars($_POST['question']);;
            $_SESSION['reponse'] = htmlspecialchars($_POST['reponse']);
        }
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
        <header>
            <?php include('./header.php');?>
        </header>
        <div class="container text-center mt-5">
            <h1>Mon Compte</h1>
            <div class="container text-center mt-5">
                <form name="sign_up_form" method="POST" action="./user_page.php">
                    <div class="form-row" style="padding: 5px">
                        <div class="col-md-4 mb-4">
                            <label for="nom"><b>Nom</b></label>
                            <input class="form-control" type="text" placeholder="<?=$user_data['nom']?>" value ="<?=$user_data['nom']?>" name="nom" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="prenom"><b>Prénom</b></label>
                            <input class="form-control" type="text" placeholder="<?=$user_data['prenom']?>" value ="<?=$user_data['prenom']?>" name="prenom" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="username"><b>Pseudo</b></label>
                            <input class="form-control" type="text" placeholder="<?=$user_data['user_name']?>" value ="<?=$user_data['user_name']?>" name="user_name" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="password"><b>Mot de passe</b></label>
                            <input class="form-control" type="password" name="password" requred>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="question"><b>Question secrète</b></label>
                            <input class="form-control" type="text" placeholder="<?=$user_data['question']?>" value ="<?=$user_data['question']?>" name="question" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="reponse"><b>Réponse secrète</b></label>
                            <input class="form-control" type="text" placeholder="<?=$user_data['reponse']?>" value ="<?=$user_data['reponse']?>" name="reponse" required>
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