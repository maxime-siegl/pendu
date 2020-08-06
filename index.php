<?php
require('Partie.php');
session_start();

if(isset($_SESSION["partie"])) {
  $partie = $_SESSION["partie"];
}

if(isset($_POST["start"])){
  $partie = new Partie;
  $_SESSION["partie"] = $partie;
}

# Remplacer les lettres en fonction de la réponse de l'user
if(isset($_POST["reponse"])){
  $partie->searchLetter($_POST["reponse"]);
}

if(isset($_POST["reset"])){
  $partie->resetAll();
}
?>

<html>
  <head>
    <title> Jeu du pendu </title>
  </head>
  <body>
    <?php
      if(!isset($_SESSION["partie"])) {
        ?>
        <form action="" method="POST">
          <button name="start"> Commencer </button>
        </form>
        <?php
      }

      if(isset($_SESSION["partie"])) {

        $partie->affichePendu();
        $partie->afficheUnderscore();

        ?>
        <form action="" method="POST">
          <label for "reponse"> Entrez une lettre : </label>
          <input type="text" name="reponse">
        </form>
    <form action="" method="POST">
      <button name="reset"> Reset </button>
    </form>
  <?php } ?>
  </body>
</html>
