<?php
    // recup des résultats
    include 'connexion_bdd.php';
    $leaderboard = $db->prepare("SELECT * FROM leaderboard INNER JOIN utilisateurs ON leaderboard.id_utilisateur = utilisateurs.id ORDER BY victoire DESC LIMIT 10");
    $leaderboard->execute();
    $result = $leaderboard->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($result);
    // var_dump(COUNT($result));
    for ($ligne = 0; $ligne < COUNT($result); $ligne++)
    {
        if($result[$ligne]['defaite'] == 0 || $result[$ligne]['game'] == 0)
        {
            $result[$ligne]['defaite'] = 1;
            $result[$ligne]['game'] = 1;
        }
        
        $ratio[$ligne] = $result[$ligne]['victoire'] / $result[$ligne]['defaite']; // ratio de victoire
        $moy_lettre[$ligne] = $result[$ligne]['nb_lettre'] / $result[$ligne]['game']; // moyenne de lettres utilisées par game

        echo '<tr>';
        echo '<td>'.$result[$ligne]['login'].'</td>';
        echo '<td>'.$result[$ligne]['victoire'].'</td>';
        echo '<td>'.$result[$ligne]['game'].'</td>';
        echo '<td>'.$ratio[$ligne].'</td>';
        echo '<td>'.$moy_lettre[$ligne].'</td>';
        echo '</tr>';
    }
?>