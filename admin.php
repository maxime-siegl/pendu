<?php
# Gestion de la liste des mots
# Ajouter - Supprimer - Afficher


$fichier = fopen('mots.txt', 'r+');

// Affichage de toutes les lignes du fichier

if ($fichier) {
    while (($ligne = fgets($fichier)) !== false) {
        echo $ligne ;
        echo "<a href='admin.php'>Supprimer un mot</a>" ;
    }
    if(isset($_POST['add_word'])){
      fputs($fichier, "<br>" .$_POST['add_word'] ); # ne se refresh pas
      header("Location:admin.php");
    }
    fclose($fichier);
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
