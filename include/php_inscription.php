<?php
  include("connexion_bdd.php");

    if (isset($_POST['inscription']) )
    {
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $confirmation = $_POST['confirmation_mdp'];

        $query = $db->prepare("SELECT * FROM utilisateurs WHERE login = '$login'");
        $query->execute();
        # Permet de vérifier s'il existe un user avec le login entré
        $result = $query->fetch(PDO::FETCH_ASSOC);


        if (empty($result))
        {
          if($mdp == $confirmation){
            echo 'Login libre.';
            $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT);
            $query = $db->prepare("INSERT INTO utilisateurs(login, mdp) VALUES ('$login', '$mdp_hash')");
            $query->execute();

            echo "Inscription réussie.";
            }
            // header('location:connexion.php');
        }
    }
?>
