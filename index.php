<?php
session_start();
# Stocker un mot = string
$mot = "testeur";
# Compter le nombre de caractères dans $mot
$nombre_lettres = strlen($mot);
$lettres = str_split($mot, 1);
# Test : remplacer des lettres puis les retrouver
 /* $translate = strtr($mot, "e", "_");
echo $translate . "<br>";

$back_to_normal = strtr($translate, "_", "e");
echo $back_to_normal . "<br>"; */




/********/

if(isset($_POST["reponse"])){
  $reponse = $_POST['reponse'];
  # Bonnes réponses
  if (in_array($reponse, $lettres)) { # le tableau $lettres doit contenir les lettres séparées, et pas une chaîne de caractères
      echo "good answer <br>";
      if(!isset($_SESSION["true"])) # Si la session n'est pas ouverte
      {
          $true = []; # on crée un tableau vide
      } else {
          $true = $_SESSION["true"]; # Si la session est ouverte, on récupère le tableau de la session
      }

      if(isset($_POST["reponse"])){ # Si le formulaire est utilisé
        array_push($true, $_POST['reponse']); # On insère dans le tableau ce qui provient du formulaire
      }

      $_SESSION["true"] = $true; # Enfin, on stocke dans la session le tableau nouvellement rempli

      var_dump($_SESSION["true"]);
  # Mauvaises réponses
  }else{
    echo "bad answer <br>";
    if(!isset($_SESSION["false"])) # Si la session n'est pas ouverte
    {
        $false = []; # on crée un tableau vide
    } else {
        $false = $_SESSION["false"]; # Si la session est ouverte, on récupère le tableau de la session
    }

    if(isset($_POST["reponse"])){ # Si le formulaire est utilisé
      # on compte combien de valeurs contient le tableau

      if(count($false) < 5)
      { # si le nombre de valeurs du tableau est inférieur à 5, on ajoute la valeur
        array_push($false, $_POST['reponse']); # On insère dans le tableau ce qui provient du formulaire
      }else{ # si le tableau contient 5 valeurs, on affiche un message sans remplir le nouveau le tableau
        echo "You failed.";
      }
    }

    $_SESSION["false"] = $false; # Enfin, on stocke dans la session le tableau nouvellement rempli

    var_dump($_SESSION["false"]);
  }
}

# *********************************
/* Faire 2 tableaux, l'un  comprenant le nombre de _ et l'autre comprenant les lettres du mot
il s'agit ensuite de chercher dans le bon index du tableau _
et d'afficher la lettre venant du seconde tableau, ou de post, à la bonne place */
# Faire un tableau comprenant autant de _ que de lettres dans le mot

$underscore_array = array_fill(0, strlen($mot), "_");
var_dump($underscore_array);

foreach($underscore_array as $element){ # Chaque $element est une lettre

  echo $element . " ";
}

$lettres = str_split($mot, 1); # Les caractères sont stockés dans un tableau
var_dump($lettres);

# Afficher le mot en séparant les lettres
foreach($lettres as $element){ # Chaque $element est une lettre

  echo $element . " ";
}



# Trouver la lettre envoyée par POST dans le $mot
if(isset($_POST['reponse'])){
  $position_lettre = strpos($mot, $_POST['reponse']);

  $reponse = $_POST['reponse'];
  $lettres = str_split($mot, 1);

  if($position_lettre !== false){
    # Permet de remplacer les _ par la bonne lettre au bon index
    # pb : ne conserve pas successivement les lettres envoyées par post
    for($i = 0; $i < strlen($mot); $i++) {

      if($lettres[$i] == $reponse) {
        if(isset($_SESSION['letter_found'])){
        $underscore_array = $_SESSION['letter_found'];
      }
        $underscore_array[$i] = $reponse;
      }
    }
    var_dump($underscore_array);
    $_SESSION['letter_found'] = $underscore_array;
    #echo "letter is found and start at $position_lettre";
  }
}

# Remplace _ par la lettre provenant du mot
# $visible_word = str_replace("_ ", $lettres, $mot);
# var_dump($visible_word);

/* Autre solution : afficher un nombre de _ égal au nombre de lettres,
puis dévoiler les lettres trouvées */


# Les lettres doivent être remplacées par des _

# Afficher l'alphabet : chaque lettre est un lien OU un bouton
# Ou afficher un simple formulaire

/* Si l'user choisit une lettre de l'alphabet qui correspond à une lettre de $mot,
on affiche la lettre correspondante */



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
  </body>
