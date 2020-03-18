<?php
    require './_db.php';
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
            <header class="">
                <?php include('./header.php'); ?>
            </header>
                
            <div class="container">
                <section class="justify-content-align my-3 p-3 bg-white rounded shadow-sm">
                    <?php include('./txt_presentation_gbaf.php');?>
                    <img class="col-sm-4 offset-sm-4 col-sm-4" width="300" height="20%"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Flag_of_France.svg/langfr-1920px-Flag_of_France.svg.png"
                    rel="drapeau france">
                </section>

                <h2 style="text-align: center">Acteurs et Partenaires</h2>
                <section class="">
                    <?php include('./section_acteurs.php'); ?>
                </section>
            </div>        

            <footer>
                <?php include('./footer.php');?>
            </footer>
        <?php include('./script.php');?> </body>    
    </html>