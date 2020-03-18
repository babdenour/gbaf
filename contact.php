<html>
    <head>
        <?php include("./head.php");?>
    </head>

    <body class="text-center">
        <header>
            <?php include('./header.php');?>
        </header>
        <h2>Nous Contacter</h2>
        <p>Un problème, une question ? Contactez-nous via le formulaire suivant.</p>
        <form method="post" action="./contact_saisie.php">
            <div class="form-group">
                <label for="exampleFormControlInput1">Email</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-dark">ENVOYER</button>
        </form>

        <footer>
            <nav class="navbar navbar-light bg-light justify-content-center">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <p class="nav-link">GBAF par Abdenour Bensouna</p>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./mentions_legales.php">Mentions Légales</a>
                    </li>
                </ul>
            </nav>
        </footer>
    <?php include('./script.php');?> 
    </body>
</html>