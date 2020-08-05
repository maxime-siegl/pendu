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
            <button type="submit" name="valider">Start random</button>
        </form>
        <?php
            if (isset($_POST['valider']) || isset($_POST['new_game']) || isset($_POST['reset']))
            {
                $fichier = file('mots.txt'); # Lit le fichier et renvoie le résultat dans un tableau
                $mot = $fichier[array_rand($fichier)]; # choisit une ligne au hasard
                # trim() permet de supprimer les guillemets en début et en fin de chaîne, le résultat est stocké dans une session
                $_SESSION["mot"] = trim($mot);
                
                $longueur = strlen($mot);
                
                $_SESSION['pendaison'] = 0; // avancé de l'image du pendu (défaite)
                $_SESSION['reponses'] = []; // ensmeble de toute les lettres qui ont été demandé
                $_SESSION['nice'] = 0; // nb d'occurence de la lettre par rapport au mot
                $_SESSION['lettre'] = ""; // lettre a comparer

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
                
                if(in_array($lettre, $_SESSION['reponses']))
                {
                    $double = true; // var verif dun doublon/ je m'en sert pour les incrementations
                    $msg_lettre = 'Vous avez déjà essayé cette lettre !!';
                }
                else
                {
                    $_SESSION['lettre'] = $lettre;
                    array_push($_SESSION['reponses'], "$lettre");
                }
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
                        if (!isset($double))
                        {
                            $_SESSION['occurence'] = $_SESSION['occurence'] + 1;
                        }
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
                if (!isset($double))
                {
                    if ($_SESSION['occurence'] == 0) // si pas d'occurence alors img pendaison avance
                    {
                        $_SESSION['pendaison'] = $_SESSION['pendaison'] + 1;
                    }
                }
                $evolution = $_SESSION['pendaison'];
                $nice = $_SESSION['nice'];
                echo '<img src="img/pendaison/'.$evolution.'.png">';

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
                        echo '<form action="index.php" method="POST">';
                        echo '<p>Vous n\'avez pas réussi à trouver notre mot, on en tente un nouveau ?</p>';
                        echo '<button type="submit" name="new_game">New Game</button>';
                        echo '</form>';
                        echo '</section>';
                    }
                }
            }
            // var_dump($caract)

        ?>
        <?php
        if (isset($nice) && isset($longueur))
        {
            if ($nice == $longueur || $evolution == 9)
            {
                echo 'LA PARTIE EST TERMINEE';
            }
            else
            {
        ?>
            <form action="" method="POST">
                <label for="lettre">Lettre à vérifier</label>
                <input type="text" name="lettre" maxlength="1">
                <button type="submit" name="chercher">Chercher</button>
            </form>
        <?php 
            }
        }
        if (isset($msg_lettre))
        {
            echo '<section class="game_msg">';
            echo $msg_lettre;
            echo '</section>';
        }
        $allrep = $_SESSION['reponses'];

        for ($l = 0; $l < COUNT($allrep); $l++)
        {
            if(isset($allrep[$l]))
            {
                echo '<section id="utilisees">';
                echo "<img src='img/alpha/$allrep[$l].png' alt='$allrep[$l]' >";
                echo '</section>';
            }
        }
        ?>
    </main>
    <footer></footer>
</body>
</html>