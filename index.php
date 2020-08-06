<?php
# Page permettant de tester la classe Partie
require('Partie.php');
session_start();

if(isset($_SESSION["partie"])) {
  $partie = $_SESSION["partie"];
}

if(isset($_POST["start"])){
  $partie = new Partie; # il faudra faire en sorte de créer d'autres parties... peut-être en créant l'objet ds post start?
  $_SESSION["partie"] = $partie;
}

# Remplacer les lettres en fonction de la réponse de l'user
if(isset($_POST["reponse"])){
  $partie->searchLetter($_POST["reponse"]); # Ne fonctionne pas encore...
}

if(isset($_POST["reset"])){
  $partie->resetAll(); # l'objet créé dans la première condition est inaccessible
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
