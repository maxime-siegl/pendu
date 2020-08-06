<?php
class Partie
{
  private $word;
  private $errors = false;
  private $good_answers = false;

  private $id_user; # Usage à spécifier ultérieurement

  public function __construct(){ # Constructeur devant permettre la recherche de mot et sa transformation en _
    $this->searchWord();
  }

  # Cherche un mot au hasard dans le fichier txt
  public function searchWord(){
    $fichier = file('mots.txt');
    $word = $fichier[array_rand($fichier)];
    $trimmed = trim($word); # Récupère la valeur sans guillemet

    $underscore_array = array_fill(0, strlen($trimmed), "_"); # remplace les lettres par des _

    $_SESSION["start"] =  $trimmed;

    $array_to_string = implode(" ", $underscore_array);
    echo $array_to_string . "<br>";
  }

  # Cherche si la lettre postée se trouve dans le mot... et la place au bon endroit ?
  public function searchLetter(){
    $word = $this->word;
    $good_answer = false;
    for($i = 0; $i < strlen($word); $i++)
    {
      if($lettres[$i] == $reponse)
      {
        $underscore_array[$i] = $reponse;
        $good_answer = true;
      }
  }
}
  # Compte le nombre d'erreurs
  public function countErrors(){
    $this->errors;
    if($answer == false){
      $_SESSION["erreurs"]++;
    }
    $erreur = $_SESSION['erreurs'];
    echo "<img src='img/pendu$erreur.jpg'>"; # Affichage d'une image en fonction du nombre de l'erreur
  }

  # Remet à zéro le nombre de lettres trouvées et le nombre d'erreurs
  public function resetAll(){
    if(isset($_POST['reset'])) {
      unset($_SESSION["letter_found"]);
      unset($_SESSION["erreurs"]);
    }
  }
}
?>
