<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu du Pendu Connexion</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <?php include '../include/header.php'; ?>
    </header>
    <main>
        <?php
            if(!isset($_SESSION['login']))
            {
        ?>
            <section id="connexion">
                <img src="" alt="Image du jeu">
                <section id="info_co">
                    <form action="connexion.php" method="POST">
                        <section id="login_co">
                            <label for="login">Login</label>
                            <input type="text" name="login">
                            <label for="mdp">Mot de Passe</label>
                            <input type="password" name="mdp">
                        </section>
                        <section id="bouton_co">
                            <button type="submit" name="connexion">Se Connecter</button>
                        </section>
                    </form>
                </section>
            </section>
        <?php
            }
            include '../include/php_connexion.php';
            if (isset($msg_imp))
            {
                echo '<section class ="msg_imp">';
                echo $msg_imp;
                echo '</section>';
            }
        ?>
    </main>
    <footer></footer>
</body>
</html>