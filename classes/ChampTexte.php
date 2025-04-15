<?php

require_once('Champ.php');

class ChampTexte extends Champ {
    public function __construct($nom, $libelle, $estObligatoire) {
        parent::__construct($nom, $libelle, $estObligatoire);
    }

    public function valider() {
        if ($this->estRecu()) {
            $valeur = $this->getValeur();
            if ($this->estObligatoire && empty($valeur)) {
                $this->erreur = "Le champ {$this->libelle} est obligatoire.";
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
        $html .= "<input type=\"text\" name=\"{$this->nom}\" id=\"{$this->nom}\"";
        if ($this->estObligatoire) {
            $html .= " required";
        }
        $html .= " autocomplete=\"off\" value=\"{$this->getValeur()}\"";
        $html .= ">";
        return $html;
    }
}

?>
