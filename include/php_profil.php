<?php
    if (isset($_SESSION['login']))
    {
        $login = $_SESSION['login'];
        $id = $_SESSION['id'];
        include '../include/connexion_bdd.php'; // enlever le include ?
        $info_query = $db->prepare("SELECT * FROM utilisateurs WHERE login = '$login' ");
        $info_query->execute();
        $infos = $info_query->fetch(PDO::FETCH_ASSOC); // recuperation des infos par rapport au login

        // Affichage tableau score
        $score_query = $db->prepare("SELECT * FROM leaderboard WHERE id_utilisateur = '$id' ");
        $score_query->execute();
        $score = $score_query->fetch(PDO::FETCH_ASSOC);

        $ratio = $score['victoire'] / $score['defaite']; // ratio de victoire
        $moy_lettre = $score['nb_lettre'] / $infos['game']; // moyenne de lettres utilisées par game
        
        // modif du profil
        if (isset($_POST['modifier']) && !empty($_POST['login']))
        {
            $loginup = $_POST['login'];
            $mdp_actuel = $_POST['mdp_actuel'];
            $new_mdp = $_POST['new_mdp'];
            $conf_newmdp = $_POST['conf_newmdp'];

            if (password_verify($mdp_actuel, $infos['mdp']))
            {
                // changement de login
                $update_log = $db->prepare("UPDATE utilisateurs SET login = '$loginup' WHERE id = '$id' ");
                $update_log->execute();
                $_SESSION['login'] = $loginup;

                // changement de mdp
                if (isset($new_mdp) && !empty($new_mdp) && !empty($conf_newmdp))
                {
                    if ($new_mdp == $conf_newmdp)
                    {
                        $hash_newmdp = password_hash($new_mdp, PASSWORD_BCRYPT);
                        $update_mdp = $db->prepare("UPDATE utilisateurs SET mdp = '$hash_newmdp' WHERE id = '$id' ");
                        $update_mdp->execute();
                        $_SESSION['mdp'] = $new_mdp;
                    }
                }

                // changement de l'avatar
                include '../include/php_avatar.php';
            }
        }
    }
    else
    {
        header('location:../index.php');
    }

?>