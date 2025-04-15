<?php

require_once('Champ.php');

class ListeDeroulante extends Champ {
    private $options;

    public function __construct($nom, $libelle, $estObligatoire) {
        parent::__construct($nom, $libelle, $estObligatoire);
        $this->options = [];
    }

    public function ajouterOption($texte) {
        $this->options[] = $texte;
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
        $html = "<label for=\"{$this->nom}\">{$this->libelle}";
        if ($this->estObligatoire) {
            $html .= " (obligatoire)";
        }
        $html .= "</label>";
        $html .= "<select name=\"{$this->nom}\" id=\"{$this->nom}\"";
        if ($this->estObligatoire) {
            $html .= " required";
        }
        $html .= ">";
        $html .= "<option value=\"\"></option>";
        foreach ($this->options as $option) {
            $selected = ($option == $this->getValeur()) ? ' selected' : '';
            $html .= "<option value=\"{$option}\"{$selected}>{$option}</option>";
        }
        $html .= "</select>";
        return $html;
    }
}

?>
