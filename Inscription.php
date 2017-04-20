<?php require_once 'ressource/function.php' ?>
<!----------------------------------------------------------------------------->

<?php

  if(!empty($_POST)){

      $errors = array();
      require_once 'ressource/PDO.php';

        if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){

          $errors['username'] = "- Votre pseudo n'est pas valide!";
        } else {

          $req = $PDO->prepare('SELECT id FROM users WHERE username = ?');
          $req->execute([$_POST['username']]);

          $users = $req->fetch();
          if($users){

            $errors['username'] = '- Ce pseudo est déjà pris...';

          }

        }

        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

          $errors['email'] = "- Votre email n'est pas valide!";
          } else {

            $req = $PDO->prepare('SELECT id FROM users WHERE email = ?');
            $req->execute([$_POST['email']]);

            $users = $req->fetch();
            if($users){

              $errors['email'] = '- Cet email est déjà utilisé...';

            }
            }
        if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){

          $errors['password'] = "- Votre mot de passe n'est pas valide...";
          }



        if (empty($errors)){

          $req = $PDO->prepare("INSERT INTO users SET username = ?, password = ?, email = ? confirmation_token = ?");
          $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
          $token = str_random(60);

          $req->execute([$_POST['username'],$password, $_POST['email'], $token]);
          $user_id = $PDO->lastInsertId();
          mail($_POST['email'], 'Confirmation de votre compte',"Afin de valider votre compte veuillez confirmer via ce lien\n\nhttp://localhost/Renaissance/confirm.php?id=$user_id&token=$token");
          header('Location: login.php');
          exit();
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


        <?php if(!empty($errors)): ?>

          <div data-closable class="callout alert-callout-subtle alert">
            <strong>Attention!</strong><br>
            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
              <span aria-hidden="true">x</span>
            </button>



          <?php foreach($errors as $error): ?>
          <?= $error; ?><br>

        <?php endforeach; ?>
          </div>
        <?php endif; ?>




        <h4 class="text-center">Crée votre compte</h4>

        <label>Pseudo
          <input type="text" name="username" placeholder="Votre pseudo"/>
        </label>

        <label>Email
          <input type="email" name="email" placeholder="Votre_email@exemple.com"/>
        </label>

        <label>Mot de passe
          <input type="password" name="password" placeholder="Votre mot de passe" />
        </label>

        <label>Confirmer mot de passe
          <input type="password" name="password_confirm" placeholder="Confirmation du mot de passe"/>
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
