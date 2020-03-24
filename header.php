<div class="container">
    <nav class="navbar navbar-white bg-white">
        <div class="offset-xs-3 col-sm-1 py-4 text-center">
            <a class="navbar-brand" href="./home.php"><img id="img_gbaf" width="70" height="70"
                src="https://user.oc-static.com/upload/2019/07/15/15631755744257_LOGO_GBAF_ROUGE%20%281%29.png"
                alt="Le logo de la GBAF">
            </a>
        </div>
        <div class="col-xs-4 py-4">
            <form class="form-inline text-right">
                <a class="nav-link active" href="./user_page.php"><?=$_SESSION['nom']?> & <?=$_SESSION['prenom']?></a>
                <a class="btn btn-sm btn-outline-secondary" type="button" href="./log_out.php">Déconnexion</a>
            </form>
        </div>
    </nav>
</div>