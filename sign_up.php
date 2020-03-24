<?php
session_start();
require './_db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
   //verif global
    if (strlen(htmlentities($_POST['user_name'])) < 4){
        ?>
        <script>
            alert('Le pseudo ne contient pas au minimum 4 caractères');
            document.location.replace("./sign_up.php");
        </script>
        <?php
    }
    if (strlen(htmlentities($_POST['password'])) < 8){
        ?>
        <script>
            alert('Le mot de passe ne contient pas au minimum 8 caractères');
            document.location.replace("./sign_up.php");
        </script>
        <?php
    }
    //end verif global
    
    if (strlen(htmlentities($_POST['user_name'])) >= 4)
    {
        
        //fetch of the username
        $user_name_verif = $pdo->prepare("SELECT COUNT(*) FROM users WHERE user_name = ?");
        $user_name_verif->execute([htmlentities($_POST['user_name'])]);
        $nbr_u_n_v = $user_name_verif->fetch();
        $user_name_verif->closeCursor();
        
        //verification if username does exist
        if ($nbr_u_n_v[0] > 1)
        {
        ?>
        <script>
            alert('Pseudo indisponible');
        </script>
        <?php
        }
        else
        {
            //hpassword
            $hpwd = htmlentities($_POST['password']);
            $password = password_hash($hpwd, PASSWORD_DEFAULT);
            
            //creation in database
            $req = $pdo->prepare("UPDATE users SET nom = ?, prenom = ?, user_name = ?, password = ?, question = ?, reponse = ? WHERE user_id = ?");
            $req->execute([
                htmlentities($_POST['nom']),
                htmlentities($_POST['prenom']),
                htmlentities($_POST['user_name']),
                $password,
                $_POST['question'],
                htmlentities($_POST['reponse']),
                $_SESSION['user_id']
                ]);
            $req->closeCursor();

            //redirection
            header('Location: ./index.php');                
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('./head.php');?>
    </head>

    <body class="container text-center mt-5">
        <a href="./index.php"><img class="mb-4" src="https://user.oc-static.com/upload/2019/07/15/15631755744257_LOGO_GBAF_ROUGE%20%281%29.png" 
        rel="logo gbaf" width="72" height="72"></a>
        <h1>Inscription</h1>
        <p>Veuillez remplir les champs</p>
        </br>
        <form method="POST" action="./sign_up.php">
            <div class="form-row" style="padding: 5px">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault01">Nom</label>
                    <input type="text" class="form-control" id="validationDefault01" placeholder="Entrez votre Nom" name="nom" required autofocus>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault02">Prénom</label>
                    <input type="text" class="form-control" id="validationDefault02" placeholder="Entrez votre prénom" name="prenom" required> 
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Pseudo (4 caractères minimum)</label>
                    <input type="text" class="form-control" id="validationDefault03" placeholder="Entrez votre Pseudo" name="user_name" required>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="validationDefault04">Mot de passe (8 caractères minimum)</label>
                    <input type="password" class="form-control" id="validationDefault04" placeholder="Entrez votre Mot de passe" name="password" required>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="question">Question secrète</label>
                    <select class="form-control" id="validationDefault05" name="question" required>
                        <option value="">Choisir votre question secrète...</option>
                        <option value="Nom de votre premier jeux vidéo.">Nom de votre premier jeux vidéo.</option>
                        <option value="Nom de jeune fille de votre maman.">Nom de jeune fille de votre maman.</option>
                        <option value="Adresse de votre habitation d'enfance.">Adresse de votre habitation d'enfance.</option>
                        <option value="Equipe de sport favorite.">Equipe de sport favorite.</option>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="validationDefault06">Réponse secrète</label>
                    <input type="text" class="form-control" id="validationDefault06" placeholder="Entrez la réponse à la question secrète" name="reponse" required>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                    <label class="form-check-label" for="invalidCheck2">
                    En créant un compte vous acceptez nos <a href="./mentions_legales.php" style="color: dodgerblue">Termes & Conditions</a>
                    </label>
                </div>
            </div>
            </br>
            <button class="btn btn-primary" type="submit">VALIDATION</button>
            <a class="btn btn-sm btn-outline-secondary" type="button" href="./index.php">Annuler</a>
        </form>
        </br>
        <footer>
            <nav class="navbar navbar-white bg-white justify-content-center col-sm-12">
                <p class="nav-link">GBAF par Abdenour Bensouna</p>        
            </nav>
        </footer>
    </body>
    <?php include('./script.php');?> </body>
</html>