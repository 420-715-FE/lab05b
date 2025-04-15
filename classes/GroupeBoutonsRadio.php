<?php

require_once('Champ.php');

class GroupeBoutonsRadio extends Champ {
    private $options;

    public function __construct($nom, $libelle, $estObligatoire) {
        parent::__construct($nom, $libelle, $estObligatoire);

        $this->options = [];
    }

    public function ajouterOption($option) {
        $this->options[] = $option;
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
