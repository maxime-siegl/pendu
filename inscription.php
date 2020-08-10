<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu du Pendu Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'include/header.php'; ?>
    </header>
    <main id="page_inscription">
        <?php
            if (!isset($_SESSION['login']))
            {
        ?>
            <form action="inscription.php" method="POST" enctype="multipart/form-data">
                <section id="inscription">
                    <section id="avatar_inscr">
                        <label for="avatar_def" >Votre Avatar (défaut)</label>
                        <img src="img/avatar/avatar_defaut.png" alt="Avatar par defaut">
                    </section>
                    <section id="infos_inscr">
                        <p>
                            <label for="login">Login</label>
                            <input type="text" name="login" required>
                        </p>
                        <p>
                            <label for="mdp">Mot de Passe</label>                        
                            <input type="password" name="mdp" required>
                        </p>
                        <p>
                            <label for="confirmation_mdp">Confirmation du Mot de Passe</label>
                            <input type="password" name="confirmation_mdp" required>
                        </p>
                    </section>
                </section>
                    <section class="bouton"><button type="submit" name="inscription">S'inscrire</button></section>
            </form>
        <?php
            include 'include/php_inscription.php';
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
    <footer>
        <?php include 'include/footer.php'; ?>
    </footer>
</body>
</html>