<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Pendu Administrateur</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <?php include 'include/header.php'; ?>
  </header>
  <main id="page_admin">
    <?php
      if ($_SESSION['login'] == 'admin' && $_SESSION['mdp'] == 'admin')
      {
        # Gestion de la liste des mots
        # Ajouter - Supprimer - Afficher
        if(isset($_POST['add_word'])){ # Permet d'ajouter des mots
          file_put_contents("mots.txt", $_POST['add_word'] . "\n", FILE_APPEND);
          header("Location:admin.php");
        }

        // Affichage de toutes les lignes du fichier
        $fichier = fopen('mots.txt', 'r+');
        $i = 0;
        echo '<section id="admin">';
        echo '<table>';
        while (($ligne = fgets($fichier)) !== false) { # Affiche la liste des mots
          echo '<tr>';
          echo '<td>';
          echo $ligne ."<br>" ."<a href='admin.php?mot=$i'>Suppression du mot du dessus</a>"  ."<br>";
          echo '</td>';
          echo '</tr>';
          $i++;

        }
        fclose($fichier);

        /*** Supprimer un mot ***/
        if(isset($_GET["mot"]))
        {
          $mot = $_GET["mot"];
          $contents = file("mots.txt"); # On stocke le contenu du fichier dans $contents
          unset($contents[$mot]);

          file_put_contents("mots.txt", $contents); # On met ce nouveau contenu dans le fichier

          header("Location: admin.php");
        }
        echo '</section>';
        echo '</table>';
      }
  ?>
  <!-- Afficher les mots se trouvant dans le fichier -->
  <form action="" method="POST">
       <label for="add_word"> Ajouter un mot </label>
       <input type="text" name="add_word">
     </form>
  </main>
  <footer>
    <?php include 'include/footer.php'; ?>
  </footer>
</body>
</html>
