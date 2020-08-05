<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu du Pendu Connexion</title>
</head>
<body>
    <header></header>
    <main>
        <?php
            if(!isset($_SESSION['login']))
            {
        ?>
                <img src="" alt="">
                <form action="connexion.php" method="POST">
                    <label for="login">Login</label>
                    <input type="text" name="login">
                    <label for="mdp">Mot de Passe</label>
                    <input type="password" name="mdp">
                    <button type="submit" name="connexion">Se Connecter</button>
                </form>
        <?php
            }
            include 'include/php_connexion.php';
            echo '<section class ="msg_imp">';
            echo $msg_imp;
            echo '</section>';
        ?>
    </main>
    <footer></footer>
</body>
</html>