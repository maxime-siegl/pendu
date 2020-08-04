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

$trimmed = trim($random); # trim() permet de supprimer les guillemets en début et en fin de chaîne
$mot = $trimmed;

echo "<br>" .$mot;
# *********************************


if(isset($_SESSION["letter_found"])) {
  $underscore_array = $_SESSION["letter_found"]; # Permet de récupérer les réponses
} else {
  $underscore_array = array_fill(0, strlen($mot), "_"); # Remplit un tableau avec des _ de la taille du mot
}


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
    # S'il y a une erreur et qu'il en existe moins de 8, on affiche une image
    if($_SESSION["erreurs"] > 0)
    {
      if($_SESSION["erreurs"] < 8)
      {
        $erreur = $_SESSION['erreurs'];
        echo "<img src='img/pendu$erreur.jpg'>";

      }elseif($_SESSION["erreurs"] == 8){ # S'il y a 8 erreurs, on affiche un message d'échec
        echo "<br>Echec.";
      }
    }

    $_SESSION['letter_found'] = $underscore_array;
}
echo "<br>Affichage du tableau underscore_array :";
var_dump($underscore_array);

# S'il n'y a plus de _ dans le tableau du mot, on affiche un message de victoire
$search_underscore = in_array("_", $underscore_array);
if($search_underscore == false){
  echo "Victoire !";
}


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
