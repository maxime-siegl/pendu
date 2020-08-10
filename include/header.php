<?php
    if (isset($_POST['deconnexion']))
    {
        session_destroy();
        header('location:connexion.php');
    }
?>

<section id="titre">
    <img src="img/pendu.png" alt="image du jeu">
    <h1>Jeu du Pendu</h1>
</section>
<section id="menu">
    <nav>
        <ul>
            <li><a href="leaderboard.php">Hall Of Fame</a></li>
            <li><a href="index.php">The Game</a></li>
            <li><a href="profil.php">Profil</a></li>
            <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin' && $_SESSION['mdp'] == 'admin')
                {
                    echo '<li>';
                    echo '<a href="admin.php">';
                    echo 'Gestion des Mots';
                    echo '</a>';
                    echo '</li>';
                }

                if(isset($_SESSION['login']))
                {
            ?>
                    <form action="" method="POST">
                        <li>
                        <button type="submit" name="deconnexion">Se Déconnecter</button>
                        </li>
                    </form>
            <?php
                }
                else
                {
            ?>
                    <li><a href="inscription.php">Inscription</a></li>
                    <li><a href="connexion.php">Connexion</a></li>
            <?php
                }
            ?>
        </ul>
    </nav>
</section>

