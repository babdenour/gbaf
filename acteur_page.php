<?php
session_start();
if (!isset($_SESSION['user_is_connected']) || !$_SESSION['user_is_connected'])
{
    header('Location: ./index.php');
}

?>
<!DOCTYPE html>
<html>
    <head>
        <?php include("./head.php"); ?>
    </head>
    
    <body class="container">
        <?php include('./header.php'); ?>
        <div>
            <?php include('./acteur_page_detail/detail_acteur.php');?>
        </div>
        <div>
            <?php include('./acteur_page_detail/detail_commentaire.php');?>
        </div>
        <footer>
            <?php include('./footer.php');?>
        </footer> 
    <?php include('./script.php');?> </body>    
</html>
