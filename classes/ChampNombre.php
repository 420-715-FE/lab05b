<?php

class ChampNombre {
    private $nom;
    private $libelle;
    private $estObligatoire;
    private $valeurMin;
    private $valeurMax;
    private $doitEtreEntier;
    private $erreur;

    public function __construct($nom, $libelle, $estObligatoire, $doitEtreEntier) {
        $this->nom = $nom;
        $this->libelle = $libelle;
        $this->estObligatoire = $estObligatoire;
        $this->doitEtreEntier = $doitEtreEntier;
        $this->valeurMin = -INF;
        $this->valeurMax = INF;
        $this->erreur = null;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setValeurMin($valeurMin) {
        $this->valeurMin = $valeurMin;
    }
    
    public function setValeurMax($valeurMax) {
        $this->valeurMax = $valeurMax;
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

    public function getErreur() {
        return $this->erreur;
    }
}

?>
