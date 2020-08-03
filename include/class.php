<?php
    class caract
    {
        public $place;
        public $caractere;
        public $aspect;
        public $position;

        public function __construct($x)
        {
            $this->place = $x;
            $this->caractere = "";
            $this->position = 0;
            $this->aspect = "";
        }

        public function setcaractere($mot, $x)
        {
            $this->caractere = $mot[$x];
        }

        public function getcaractere()
        {
            return $this->caractere;
        }

        public function setposition($binaire)
        {
            $this->position = $binaire;
        }

        public function getposition()
        {
            return $this->position;
        }

        public function setaspect($mot, $x)
        {
            $this->aspect = $mot[$x].'.png';
        }

        public function getaspect()
        {
            return $this->aspect;
        }
    }
?>