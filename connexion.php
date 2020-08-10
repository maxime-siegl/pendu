<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu du Pendu Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'include/header.php'; ?>
    </header>
    <main>
        <?php
            if(!isset($_SESSION['login']))
            {
        ?>
            <section id="connexion">
            <p id="phrase">Oh la malheureux !! Avant de jouer, il faut se connecter <br> 
            Et si tu n'as pas de compte chez nous, passes par l' <a href="inscription.php">inscription</a></p>
                <img src="img/jeu_du_pendu.png" alt="Image du jeu">
                <section id="info_co">
                    <form action="connexion.php" method="POST">
                        <section id="login_co">
                            <p>
                                <label for="login">Login</label>
                                <input type="text" name="login">
                            </p>
                            <p>
                                <label for="mdp">Mot de Passe</label>
                                <input type="password" name="mdp">
                            </p>
                        </section>
                        <section class="bouton">
                            <button type="submit" name="connexion">Se Connecter</button>
                        </section>
                    </form>
                </section>
            </section>
        <?php
            }
            include 'include/php_connexion.php';
            if (isset($msg_imp))
            {
                echo '<section class ="msg_imp">';
                echo $msg_imp;
                echo '</section>';
            }
        ?>
    </main>
    <footer>
            <?php include 'include/footer.php' ; ?>
    </footer>
</body>
</html>