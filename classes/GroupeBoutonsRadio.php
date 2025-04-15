<?php

class GroupeBoutonsRadio {
    private $nom;
    private $libelle;
    private $estObligatoire;
    private $options;
    private $erreur;

    public function __construct($nom, $libelle, $estObligatoire) {
        $this->nom = $nom;
        $this->libelle = $libelle;
        $this->estObligatoire = $estObligatoire;
        $this->options = [];
        $this->erreur = null;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function ajouterOption($option) {
        $this->options[] = $option;
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

    public function valider() {
        if ($this->estRecu()) {
            $valeur = $this->getValeur();
            if ($this->estObligatoire && empty($valeur)) {
                $this->erreur = "Le champ {$this->libelle} est obligatoire.";
            }
            if (!in_array($valeur, $this->options)) {
                $this->erreur = "Le champ {$this->libelle} doit être une option valide.";
            }
        } else if ($this->estObligatoire) {
            $this->erreur = "Le champ {$this->libelle} est obligatoire.";
        }
    }

    public function getErreur() {
        return $this->erreur;
    }

    public function html() {
        $html = "<fieldset>";
        $html .= "<legend>{$this->libelle}";
        if ($this->estObligatoire) {
            $html .= " (obligatoire)";
        }
        $html .= "</legend>";
        foreach ($this->options as $option) {
            $html .= "<label for =\"{$this->nom}_{$option}\" />";
            $html .= "<input type=\"radio\" name=\"{$this->nom}\" id=\"{$this->nom}_{$option}\" value=\"{$option}\"";
            if ($this->estObligatoire) {
                $html .= " required";
            }
            if ($this->getValeur() == $option) {
                $html .= " checked";
            }
            $html .= "/>";
            $html .= $option;
        }
        $html .= "</fieldset>";
        return $html;
    }
}

?>
