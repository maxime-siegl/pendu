<?php
    if (isset($_POST['connexion']) && !empty($_POST['login']) && !empty($_POST['mdp']))
    {
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];

        $bdd = "SELECT login FROM utilisateurs WHERE login = '$login'";
        $verif_log = mysqli_query($bdd, $verif_log);
        $verif = mysqli_fetch_all($verif_log);

        if (!empty($verif))
        {
            if (password_verify($mdp, $verif[0]['mdp']))
            {
                session_start();
                $_SESSION['login'] = $verif[0]['login'];
                $_SESSION['pseudo'] = $verif[0]['pseudo'];
                $_SESSION['mdp'] = $verif[0]['mdp'];
                header('location:index.php');
            }
            else
            {
                $msg_imp = 'le mot de passe n\'est pas bon';
            }
        }
        else
        {
            $msg_imp = 'Login inexistant';
        }
    }
?>