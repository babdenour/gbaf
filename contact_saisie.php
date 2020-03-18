<?php
require './_db.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("./head.php");?>
    </head>

    <body>
        <header>
            <?php include('./header.php');?>
        </header>
        <main style="text-align: center">
            <h1>Message bien reçu</h1>
            <h4>Votre email : </h4>;
            <p><?= htmlspecialchars($_POST['email'])?></p>';
            <h4>Votre message : </h4>;
            <p><?= htmlspecialchars($_POST['message'])?></p>';
            <?php header('Location: ./index.php');?>
        </main>
        <footer>
            <?php include('./footer.php');?>
        </footer>
    <?php include('./script.php');?> 
    </body>
</html>