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
            if (isset($_POST['valider']) && !empty($_POST['mot_pendu'])) // mot rentré dans le form
            {
                $mot = $_POST['mot_pendu'];
                $longueur = strlen($mot);
                
                $_SESSION['pendaison'] = 0;
                $_SESSION['reponses'] = [];
                $_SESSION['nice'] = 0;
                $_SESSION['lettre'] = "";

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

            if (isset($_SESSION['jeu'])) // stocké l'état du jeu
            {
                $caract = $_SESSION['jeu'];
                $longueur = $_SESSION['taille'];
            }

            if (isset($_POST['chercher']) && !empty($_POST['lettre'])) // lettre rentré dans le form
            {
                $lettre = $_POST['lettre'];
                $_SESSION['lettre'] = $lettre;
                array_push($_SESSION['reponses'], "$lettre");
            }

            if (isset($caract)) // si le jeu a été créé
            {
                $caract = $_SESSION['jeu'];
                $_SESSION['occurence'] = 0;
                $lettre = $_SESSION['lettre'];
                
                for ($x = 0; $x < $longueur; $x++) // boucle du nombre de lettre du mot
                {
                    if ($lettre == $caract[$x]->getcaractere()) // comparaison =
                    {
                        $caract[$x]->setposition(1);
                        $_SESSION['occurence'] = $_SESSION['occurence'] + 1;
                    }
                    
                    $_SESSION['jeu'] = $caract;

                    if ($caract[$x]->getposition() == 0) // affichage des traits à la place des lettres
                    {
                        echo '<img src="img/alpha/back.png" alt="back">';
                    }
                    else
                    {
                        $image = $caract[$x]->getaspect();
                        echo "<img src='img/alpha/$image'>";
                    }
                }
                $_SESSION['nice'] = $_SESSION['nice'] + $_SESSION['occurence']; 
                
                var_dump($_SESSION['occurence']);
                if ($_SESSION['occurence'] == 0) // si pas d'occurence alors img pendaison avance
                {
                    $_SESSION['pendaison'] = $_SESSION['pendaison'] + 1;
                }
                $evolution = $_SESSION['pendaison'];
                $nice = $_SESSION['nice'];
                echo '<img src="img/pendaison/'.$evolution.'.png">';
                
                var_dump($_SESSION['reponses']); // sortir le tab des lettres testé...
                var_dump($_SESSION['nice']);
                var_dump($evolution);

                // condition de fin de game
                if ($nice == $longueur)
                {
                    $game = 'win';
                    // echo 'VOUS AVEZ GAGNE !!';
                }
                elseif ($evolution == 9)
                {
                    $game = 'loose';
                    // echo 'VOUS AVEZ PERDU !!';
                }

                if (isset($game))
                {
                    if($game == 'win')
                    {
                        echo '<section class="popwin">';
                        echo '<p>Vous avez réussi à trouver notre mot, on passe au prochain ?</p>';
                        echo '<button type="submit" name="new_game">New Game</button>';
                        echo '</section>';
                    }
                    else if ($game == 'loose')
                    {
                        echo '<section class="poploose">';
                        echo '<p>Vous n\'avez pas réussi à trouver notre mot, on en tente un nouveau ?</p>';
                        echo '<button type="submit" name="new_game">New Game</button>';
                        echo '</section>';
                    }
                }
            }
            // var_dump($caract)

        ?>
        <?php
            if ($nice == $longueur || $evolution == 9)
            {
                echo 'LA PARTIE EST TERMINEE';
            }
            else
            {
        ?>
            <form action="" method="POST">
                <label for="lettre">Lettre à vérifier</label>
                <input type="text" name="lettre">
                <button type="submit" name="chercher">Chercher</button>
            </form>
        <?php 
            }
        ?>
    </main>
    <footer></footer>
</body>
</html>