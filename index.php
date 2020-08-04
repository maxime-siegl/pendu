<?php
session_start();
# Réinitialise les variables de session quand le bouton reset est utilisé
if(isset($_POST['reset'])) {
  unset($_SESSION["letter_found"]);
  unset($_SESSION["erreurs"]);
}
# Si première connexion, on initialise le nombre d'erreur
if(!isset($_SESSION["erreurs"])) {
  $_SESSION["erreurs"] = 0;
}
# Récupération de mots dans le fichier mots.txt
$fichier = file('mots.txt'); # renvoie les résultats du fichier dans un tableau
$random = $fichier[array_rand($fichier)]; # choisit une ligne au hasard
echo $random;
var_dump($random);

$mot = "test"; # Devra être remplacé par l'un des mots du fichier mots.txt
echo "Mot permettant d'effectuer des tests : " . $mot;
# *********************************


if(isset($_SESSION["letter_found"])) {
  $underscore_array = $_SESSION["letter_found"]; # Permet de récupérer les réponses
} else {
  $underscore_array = array_fill(0, strlen($mot), "_"); # Remplit un tableau avec des _ de la taille du mot
}

/****** A placer au bon endroit *****/
# Condition pouvant permettre l'affichage d'un message de victoire : reste à la placer au bon endroit
if($underscore_array == strlen($mot)){ #il faudrait autre chose que underscore_array, car sa taille est fixe...
  echo "Victoire !";
}

/********************************/

# Trouver la lettre envoyée par POST dans le $mot
if(isset($_POST['reponse']))
{
    $reponse = $_POST['reponse'];
    $lettres = str_split($mot, 1); # On convertit le $mot en tableau

    $nb_juste = false;
    # Boucle permettant de remplacer les _ par des lettres
    for($i = 0; $i < strlen($mot); $i++)
    {
      if($lettres[$i] == $reponse)
      {
        $underscore_array[$i] = $reponse;
        $nb_juste = true;
      }
    }
    if($nb_juste == false)
    {
      $_SESSION["erreurs"]++;
    }

    if($_SESSION["erreurs"] < 7){
      $erreur = $_SESSION['erreurs'];
      echo "<img src='img/pendu$erreur.jpg'>";
    }else{
      echo "Echec.";
    }

    $_SESSION['letter_found'] = $underscore_array;
}
echo "<br>Affichage du tableau underscore_array :";
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
