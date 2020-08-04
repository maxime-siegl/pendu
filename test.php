<?php
    $fichier = file('mots.txt'); # Lit le fichier et renvoie le résultat dans un tableau
    $mot = $fichier[array_rand($fichier)]; # choisit une ligne au hasard
    # trim() permet de supprimer les guillemets en début et en fin de chaîne, le résultat est stocké dans une session
    $_SESSION["mot"] = trim($mot);

    var_dump($random);
    var_dump($_SESSION['trimmed']);
?>