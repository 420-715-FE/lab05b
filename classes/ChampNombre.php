<?php

require_once('Champ.php');

class ChampNombre extends Champ {
    private $valeurMin;
    private $valeurMax;
    private $doitEtreEntier;

    public function __construct($nom, $libelle, $estObligatoire, $doitEtreEntier) {
        parent::__construct($nom, $libelle, $estObligatoire);
        
        $this->doitEtreEntier = $doitEtreEntier;
        $this->valeurMin = -INF;
        $this->valeurMax = INF;
    }
  
    public function setValeurMin($valeurMin) {
        $this->valeurMin = $valeurMin;
    }
    
    public function setValeurMax($valeurMax) {
        $this->valeurMax = $valeurMax;
    }

    public function valider() {
        if ($this->estRecu()) {
            $valeur = $this->getValeur();
            if (!$this->estObligatoire && empty($valeur)) {
                return;
            }
            if (empty($valeur)) {
                $this->erreur = "Le champ {$this->libelle} est obligatoire.";
            } elseif (!is_numeric($valeur)) {
                $this->erreur = "Le champ {$this->libelle} doit être un nombre.";
            } elseif ($this->doitEtreEntier && !is_int($valeur + 0)) {
                $this->erreur = "Le champ {$this->libelle} doit être un entier.";
            } elseif ($valeur < $this->valeurMin || $valeur > $this->valeurMax) {
                $this->erreur = "Le champ {$this->libelle} doit être entre {$this->valeurMin} et {$this->valeurMax}.";
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
        $html .= "<input autocomplete=\"off\" type=\"text\" name=\"{$this->nom}\" id=\"{$this->nom}\"";
        if ($this->estObligatoire) {
            $html .= " required";
        }
        $html .= " value=\"{$this->getValeur()}\"";
        $html .= ">";
        return $html;
    }
}

?>
