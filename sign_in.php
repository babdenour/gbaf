<form class="form-signin" method="POST" action="./validation_sign_in.php">
    <img class="mb-4" src="https://user.oc-static.com/upload/2019/07/15/15631755744257_LOGO_GBAF_ROUGE%20%281%29.png" 
    alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Connectez-vous</h1>
    <a class="btn btn-sm btn-outline-secondary col-sm-4 mt-4 mb-4" type="button" href="./sign_up.php">Pas de compte ?</a>
    <label for="inputUserName" class="sr-only">UserName</label>
    <input type="text" id="inputEmail" class="form-control" placeholder="Pseudo" name="user_name" required autofocus>
</br>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" name="password" required>
    <a class="nav-link active float-left" href="./reset_password/recup_password.php">Mot de passe oublié ?</a>
    </br>
    </br>
    <button class="btn btn-lg btn-primary btn-block mb-4" type="submit">Connexion</button>
</form>
