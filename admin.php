<?php
# Gestion de la liste des mots
# Ajouter - Supprimer - Afficher


$fichier = fopen('mots.txt', 'r+');

// Affichage de toutes les lignes du fichier

if ($fichier) {
    while (($ligne = fgets($fichier)) !== false) {
        echo $ligne . "<br>";
    }
    if(isset($_POST['add_word'])){
      fputs($fichier, $_POST['add_word']. "<br>"); # ne se refresh pas
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

     <form action="" method="POST">
       <button name="delete_word"> Supprimer un mot </button>
     </form>

   </body>
