<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu du Pendu Profil</title>
</head>
<body>
    <header></header>
    <main>
    <?php include '../include/php_profil.php'; ?>
        <section id ="profil_info">
            <form action="profil.php" method="POST" enctype="multipart/form-data">
                <section id="info_profil">
                    <label for="login">Votre Login</label>
                    <input type="text" name="login" value="<?php echo $_SESSION['login']; ?>">
                    <label for="mdp_actuel">Mot de Passe Actuel</label>
                    <input type="password" name="mdp_actuel">
                    <label for="new_mdp">Nouveau Mot de Passe</label>
                    <input type="password" name="new_mdp">
                    <label for="conf_newmdp">Confirmation du Nouveau Mot de Passe</label>
                    <input type="password" name="conf_newmdp">
                </section>
                <section id="avatar_profil">
                    <img src="<?php echo $infos['avatar'] ;?>" alt="avatar img">
                    <input type="file" name="avatar">
                </section>
                <section id="bouton_profil">
                    <button type="submit" name="modifier">Modifier</button>
                </section>
            </form>
        </section>
        <section id="tab_score">
            <table>
                <thead>
                    <tr>
                    <td>Statistiques des Tes Games</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $infos['game']; ?></td>
                        <td><?php echo $score['victoire']; ?></td>
                    </tr>
                    <tr>
                        <td>
                            Ration V/D: <br>
                            <?php echo $ratio; ?>
                        </td>
                        <td>
                            Moyenne de Lettres utilisées / partie: <br>
                            <?php echo $moy_lettre; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
    <footer></footer>
</body>
</html>