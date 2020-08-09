<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu du Pendu Leaderboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<header>
        <?php include 'include/header.php'; ?>
    </header>
    <main>
        <h1>Hall Of Fame</h1>
        <table>
            <thead>
                <th>Top 10 Ratio</th>
            </thead>
            <tbody>
                <tr>
                    <td>Pseudo</td>
                    <td>Victoire</td>
                    <td>Nombre de game</td>
                    <td>ratio V/D</td>
                    <td>Moyenne de lettres utilisées</td>
                </tr>
                <?php include 'include/php_leaderboard.php';  ?>
            </tbody>
        </table>
    </main>
    <footer></footer>
</body>
</html>