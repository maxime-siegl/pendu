<?php 
    include 'include/class.php';
    session_start(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu du Pendu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header></header>
    <main>
        <form action="index.php" method="POST">
            <label for="mot_pendu">Mot a faire deviner:</label>
            <input type="text" name="mot_pendu">
            <button type="submit" name="valider">Valider</button>
        </form>
        <?php
            if (isset($_POST['valider']) && !empty($_POST['mot_pendu']))
            {
                $mot = $_POST['mot_pendu'];
                $longueur = strlen($mot);
                
                // $tab_mot = str_split($mot, 1);

                for ($x = 0; $x < $longueur; $x++) // création des lettres du mot pendu...
                {
                    $caract[$x] = new caract($x);
                    $caract[$x]->setcaractere($mot, $x);
                    $caract[$x]->setaspect($mot, $x);
                    $caract[$x]->setposition(0);
                }

                $_SESSION['jeu'] = $caract;
                $_SESSION['taille'] = $longueur;

                // var_dump($caract);
            }

            if (isset($_SESSION['jeu']))
            {
                $caract = $_SESSION['jeu'];
                $longueur = $_SESSION['taille'];
            }

            if (isset($caract))
            {
                $caract = $_SESSION['jeu'];

                for ($x = 0; $x < $longueur; $x++)
                {
                        if (isset($_POST['chercher']) && !empty($_POST['lettre']))
                        {
                            $lettre = $_POST['lettre'];
        
                            if ($lettre == $caract[$x]->getcaractere())
                            {
                                $caract[$x]->setposition(1);
                            }
                        }
                        $_SESSION['jeu'] = $caract;
                    // var_dump($lettre);
                    // var_dump($caract[$x]->getcaractere());
                    if ($caract[$x]->getposition() == 0)
                    {
                        echo '<button type="submit" name="couvert">caché</button>';
                        echo '<br>';
                    }
                    else
                    {
                        echo $caract[$x]->getaspect();
                        echo '<br>';
                    }
                }
                
            }
            // var_dump($caract)

        ?>
        <form action="" method="POST">
            <label for="lettre">Lettre à vérifier</label>
            <input type="text" name="lettre">
            <button type="submit" name="chercher">Chercher</button>
        </form>
    </main>
    <footer></footer>
</body>
</html>