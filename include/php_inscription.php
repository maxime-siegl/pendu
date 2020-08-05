<?php
    if (isset($_POST['inscription']) && !empty($_POST['pseudo']) && !empty($_POST['login']) && !empty($_POST['mdp']))
    {
        $pseudo = $_POST['pseudo'];
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $conf = $_POST['confirmation_mdp'];

        $bdd = mysqli_connect("localhost", "root", "", "pendu");
        $req = "SELECT * FROM utilisateurs WHERE login = '$login'";
        $verif = mysqli_query($bdd, $req);
        $result = mysqli_fetch_all($verif);
        // var_dump($result);

        if (empty($result))
        {
            echo 'libre';
            $req_ajout = "INSERT INTO utilisateurs('pseudo', 'login') VALUES ('$pseudo', '$login')";
            $ajout = mysqli_query($bdd, $req_ajout);
            
            if ($mdp == $conf && !empty($mdp) && !empty($conf))
            {
                echo ' mdp';
                $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT);
                $req_ajout_mdp = "INSERT INTO utilisateurs ('mdp') VALUES ('$mdp_hash') ";
                $ajout_mdp = mysqli_query($bdd, $req_ajout_mdp);
            }
            // header('location:connexion.php');
        }
    }
?>