<?php
# Gestion de la liste des mots
# Ajouter - Supprimer - Afficher

$fichier = fopen('mots.txt', 'r+');
# Pb de l'affichage en ligne dans le fichier mots.txt
// Affichage de toutes les lignes du fichier

if ($fichier) {
    while (($ligne = fgets($fichier)) !== false) {
        echo $ligne . "<a href='admin.php'>Supprimer un mot</a>"  ."<br>";
    }
    if(isset($_POST['add_word'])){
      fwrite($fichier, $_POST['add_word'] . "\n" );
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
