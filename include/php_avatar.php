<?php
// var_dump($_FILES);
if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) // si li y a un avatar et que son nom n'est pas vide
{
    // var_dump('traitement du fichier');
    $tailleMax = 2097152; // taille 2Mo
    $extensions_valides = array('jpg', 'jpeg', 'gif', 'png'); // extension qu'on prend en compte (eviter des hack ou des formats pas appropriés)
    if ($_FILES['avatar']['size'] <= $tailleMax)
    {
        // var_dump('taille ok');
        $extension_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1)); // recup l'extension du fichier, onn recup ce qu'il y a apres le point dans le nom du fichier
        if (in_array($extension_upload, $extensions_valides)) // si lextension du fichier est conforme
        {
            // var_dump('ext ok');
            $localisation = "../img/avatar/".$_SESSION['id'].".".$extension_upload ; //lieu de stockage forcé
            $avatar_file = $_FILES['avatar']['tmp_name'];
            $resultat = move_uploaded_file($avatar_file, '../img/avatar/'.$_SESSION['id'].'.'.$extension_upload); // on déplace le fichier dans le lieu de sotckae forcé
            // var_dump($localisation);
            // var_dump($avatar_file);
            // var_dump($resultat);

            if ($resultat)
            {
                // var_dump('resultat ok');
                $avatar_img = $localisation;
                $update_avatar = $db->prepare("UPDATE utilisateurs SET avatar = '$avatar_img' WHERE id = '$id' ");
                $update_avatar->execute();
                
                $_SESSION['avatar'] = $avatar_img;
                // var_dump($avatar_img);
                header('location:profil.php');
            }
            else
            {
                $message_erreur = "Erreur durant l'importation de la photo...";
            }
        }
        else
        {
            $message_erreur = "Votre photo de profil n'est pas au bon format (jpg, jpeg, gif ou png)!";
        }
    }
    else
    {
        $message_erreur = "Votre photo de profil ne peut pas dépasser 2Mo!";
    }
}
?>