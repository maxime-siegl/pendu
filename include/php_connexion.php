<?php
    if (isset($_POST['connexion']) && !empty($_POST['login']) && !empty($_POST['mdp']))
    {
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];

        include 'connexion_bdd.php';
        $query = $db->prepare("SELECT * FROM utilisateurs WHERE login = '$login'");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        var_dump($result);
        if (!empty($result))
        {
            if (password_verify($mdp, $result['mdp']))
            {
                $_SESSION['id'] = $result['id'];
                $_SESSION['login'] = $result['login'];
                $_SESSION['mdp'] = $mdp;
                $_SESSION['game'] = $result['game'];
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