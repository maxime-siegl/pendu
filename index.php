<?php
session_start();
if(isset($_POST['reset'])) {
  unset($_SESSION["letter_found"]);
  unset($_SESSION["erreurs"]);
}
if(!isset($_SESSION["erreurs"])) {
  # Si première connexion, on initialise le nombre d'erreur
  $_SESSION["erreurs"] = 0;
}

$mot = "testeur";

# *********************************

if(isset($_SESSION["letter_found"])) {
  $underscore_array = $_SESSION["letter_found"];
} else {
  $underscore_array = array_fill(0, strlen($mot), "_");
}

# Trouver la lettre envoyée par POST dans le $mot
if(isset($_POST['reponse'])) {
  $reponse = $_POST['reponse'];
  $lettres = str_split($mot, 1); # On convertit le $mot en tableau

  # Permet de remplacer les _ par la bonne lettre au bon index
  $nb_juste = 0;
  for($i = 0; $i < strlen($mot); $i++)
  {

    if($lettres[$i] == $reponse)
    {
      $underscore_array[$i] = $reponse;
      $nb_juste++;
    }
  }
  if($nb_juste == 0)
  {
    $_SESSION["erreurs"]++;
    $erreur = $_SESSION['erreurs'];
    echo "<img src='img/pendu$erreur.jpg'>";
  }

  $_SESSION['letter_found'] = $underscore_array;
}

var_dump($underscore_array);

?>
<html>
  <head>
    <title> Jeu du pendu </title>
  </head>
  <body>
    <form action="" method="POST">
      <label for "reponse"> Entrez une lettre : </label>
      <input type="text" name="reponse">
    </form>

    <form action="" method="POST">
      <button name="reset"> Reset </button>
    </form>

  </body>
