<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu du Pendu Inscription</title>
</head>
<body>
    <header></header>
    <main>
        <?php
            if (!isset($_SESSION['login']))
            {
        ?>
                <form action="inscription.php" method="POST" enctype="multipart/form-data">
                    <section id="avatar_inscr">
                        <label for="avatar_def">Votre Avatar (défaut)</label>
                        <img src="img/avatar/avatar-defaut.jpg" alt="Avatar par defaut">
                    </section>
                    <section id="infos_inscr">
                        <label for="login">Login</label>
                        <input type="text" name="login" required>
                        <label for="mdp">Mot de Passe</label>
                        <input type="password" name="mdp" required>
                        <label for="confirmation_mdp">Confirmation du Mot de Passe</label>
                        <input type="password" name="confirmation_mdp" required>
                    </section>
                    <section class="bouton"><button type="submit" name="inscription">S'inscrire</button></section>
                </form>
        <?php
            include '../include/php_inscription.php';
            }
            else
            {
                $msg_imp = 'Tu es deja inscrit';

                echo '<section class="msg_imp">';
                echo $msg_imp.$_SESSION['login'];
                echo '</section>';
            }
        ?>
    </main>
    <footer></footer>
</body>
</html>