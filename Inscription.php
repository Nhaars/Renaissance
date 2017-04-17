<?php require_once 'ressource/PDO.php' ?>
<?php require_once 'ressource/function.php' ?>
<!----------------------------------------------------------------------------->

<?php

  if(!empty($_POST)){

      $errors = array();


        if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){ 

          $errors['username'] = "Votre pseudo n'est pas valide!";
          }

        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

          $errors['email'] = "Votre email n'est pas valide!";
          }

        if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){

          $errors['password'] = "Votre password n'est pas valide!";
          }


    //debug($errors); //permet de voir les messages d'erreurs.
  }
 ?>

<!----------------------------------------------------------------------------->

<!doctype html>
<html class="no-js" lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J'apprend la programmation</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
<!----------------------------------------------------------------------------->

<body>

<br><br><br>


    <div class="row">

      <div class="small-4 small-centered columns"><form action="" method="POST" class="log-in-form">
        <h4 class="text-center">Crée votre compte</h4>

        <label>Pseudo
          <input type="text" name="username" placeholder="Votre pseudo"/>
        </label>

        <label>Email
          <input type="email" name="email" placeholder="Votre_email@exemple.com"/>
        </label>

        <label>Mot de passe
          <input type="password" name="password" />
        </label>

        <label>Confirmer mot de passe
          <input type="password" name="password_confirm" placeholder="Confirmation"/>
        </label>


        <p><input type="submit" class="button success expanded" value="S'enregistrer"></input></p>
        <p class="text-center"><a href="#">Vous avez perdu votre mot de passe?</a></p>
      </form></div>
    </div>

<!----------------------------------------------------------------------------->
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
