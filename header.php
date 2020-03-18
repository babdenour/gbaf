<?php
if (!isset($_SESSION['user_is_connected']) || !$_SESSION['user_is_connected'])
{
   ?> <h1 class="h3 mb-3 font-weight-normal"><a href="./index.php">Connectez-vous</a></h1><?php
}
else
{
?>

    <nav class="navbar navbar-white bg-white  container-fluid">
        <a class="navbar-brand" href="./home.php"><img id="img_gbaf" width="50" height="50"
            src="https://user.oc-static.com/upload/2019/07/15/15631755744257_LOGO_GBAF_ROUGE%20%281%29.png"
            alt="Le logo de la GBAF">
        </a>
        <form class="form-inline text-right col-xs-4">
            <a class="nav-link active" href="./user_page.php"><?=$_SESSION['nom']?> & <?=$_SESSION['prenom']?></a>
            <a class="btn btn-sm btn-outline-secondary" type="button" href="./log_out.php">Se déconnecter</a>
        </form>
    </nav>
<?php
}