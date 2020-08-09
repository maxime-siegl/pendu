<?php
# Gestion de la liste des mots
# Ajouter - Supprimer - Afficher
if(isset($_POST['add_word'])){ # Permet d'ajouter des mots
  file_put_contents("mots.txt", $_POST['add_word'] . "\n", FILE_APPEND);
  header("Location:admin.php");
}

// Affichage de toutes les lignes du fichier
$fichier = fopen('mots.txt', 'r+');
$i = 0;
while (($ligne = fgets($fichier)) !== false) { # Affiche la liste des mots
  echo $ligne . "<a href='admin.php?mot=$i'>Supprimer un mot</a>"  ."<br>";
  $i++;
}
fclose($fichier);

/*** Supprimer un mot ***/
if(isset($_GET["mot"]))
{
  $mot = $_GET["mot"];
  $contents = file("mots.txt"); # On stocke le contenu du fichier dans $contents
  unset($contents[$mot]);

  file_put_contents("mots.txt", implode("\n", $contents)); # On met ce nouveau contenu dans le fichier

  header("Location: admin.php");
}

 ?>
 <html>
   <head>
     <title> Liste de mots </title>
   </head>
   <body>
     <!-- Afficher les mots se trouvant dans le fichier -->
     <form action="" method="POST">
       <label for "add_word"> Ajouter un mot </label>
       <input type="text" name="add_word">
     </form>


   </body>
