<?php

abstract class Champ {
    protected $nom;
    protected $libelle;
    protected $estObligatoire;
    protected $erreur;

    public function __construct($nom, $libelle, $estObligatoire) {
        $this->nom = $nom;
        $this->libelle = $libelle;
        $this->estObligatoire = $estObligatoire;
        $this->erreur = null;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function estRecu() {
        return isset($_POST[$this->nom]);
    }

    public function getValeur() {
        if ($this->estRecu()) {
            return htmlspecialchars(trim($_POST[$this->nom]));
        }
        return null;
    }

    public function getErreur() {
        return $this->erreur;
    }

    abstract public function valider();

    abstract public function html();
}
