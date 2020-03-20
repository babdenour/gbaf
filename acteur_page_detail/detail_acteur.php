<?php
require './_db.php';

if (!isset($_SESSION['user_is_connected']) || !$_SESSION['user_is_connected'])
{
    header('Location: ./index.php');
}

$_SESSION['id'] = htmlentities($_GET['id']);
//fetch of the actor
$req = $pdo->prepare("SELECT * FROM acteurs WHERE acteur_id = ?");
$req->execute([$_GET['id']]);
$acteur_elt = $req->fetchALL();
$req->closeCursor();
?>

<div class="container">
    <?php
    foreach($acteur_elt as $acteur)
    {
    ?>
        <div class="text-center ">
          <img width="80%" height="80%" src="<?=$acteur['acteur_picture_path']?>" class="rounded" alt="<?=$acteur['acteur_name']?>">
        </div>
        <div class="jumbotron p-3 p-md-5 rounded bg-white">
                <div class="col-md-6 px-0">
                  <h1 class=""><?=$acteur['acteur_name']?></h1>
                  <p class="lead col-xs-4 my-4"><?=$acteur['text_contenu']?></p>
                </div>
        </div>
    <?php
    }
?>