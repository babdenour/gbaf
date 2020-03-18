<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include('./head.php');?>
    </head>
    
    <body class="container">
        <header>
            <?php include('./header.php');?>
        </header>

        <div class="m-5">
            <?php include('./txt_mentions_legales.php');?>
        </div>

        <footer>
            <nav class="navbar navbar-white bg-white justify-content-center">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <p class="nav-link">GBAF par Abdenour Bensouna</p>  
                    </li>
                </ul>
            </nav>
        </footer>
        <?php include('./script.php');?> 
    </body>
</html>