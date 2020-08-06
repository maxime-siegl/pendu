<?php
class Partie
{
  private $word;
  private $errors = 0;
  private $good_answers = false;
  private $underscore_array;

  private $id_user; # Usage à spécifier ultérieurement

  public function __construct(){ # Constructeur devant permettre la recherche de mot et sa transformation en _
    $this->searchWord();
  }

  public function __get($word) {
    return $this->word;
  }

  # Cherche un mot au hasard dans le fichier txt
  public function searchWord(){
    $fichier = file('mots.txt');
    $this->word = trim($fichier[array_rand($fichier)]); # Récupère la valeur sans guillemet
    $this->underscore_array = array_fill(0, strlen($this->word), "_"); # remplace les lettres par des _
  }

  public function afficheUnderscore() {
    var_dump($this->word);
    echo var_dump(implode(" ", $this->underscore_array)); # transforme en string le tableau
  }

  # Cherche si la lettre postée se trouve dans le mot... et la place au bon endroit ?
  public function searchLetter($reponse){
    $lettres = str_split($this->word);
    $good_answer = false;
    for($i = 0; $i < strlen($this->word); $i++)
    {
      if($lettres[$i] == $reponse)
      {
        $this->underscore_array[$i] = $reponse;
        $good_answer = true;
      }
    }

    if($good_answer == false) {
      $this->errors++;
    }
}
  # Compte le nombre d'erreurs
  public function affichePendu(){
    if($this->errors > 0) {
      echo "<img src='img/pendu$this->errors.jpg'>"; # Affichage d'une image en fonction du nombre de l'erreur

    }
  }

  # Remet à zéro le nombre de lettres trouvées et le nombre d'erreurs
  public function resetAll(){
    unset($_SESSION["partie"]);
  }
}
?>
