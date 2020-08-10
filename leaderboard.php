<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu du Pendu Leaderboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <?php include 'include/header.php'; ?>
    </header>
    <main id="leaderboard">
        <h1>Hall Of Fame</h1>
        <section id="tab_leader">
            <h3>Top 10 Ratio</h3>
            <table>
                <thead>
                    <th>Pseudo</th>
                    <th>Victoire</th>
                    <th>Nombre de game</th>
                    <th>ratio V/D</th>
                    <th>Moyenne de lettres utilisées</th>
                </thead>
                <tbody>
                <?php include 'include/php_leaderboard.php';  ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <?php include 'include/footer.php'; ?>
    </footer>
</body>
</html>