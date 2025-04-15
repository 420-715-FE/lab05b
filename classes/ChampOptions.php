<?php

require_once('Champ.php');

abstract class ChampOptions extends Champ {
    protected $options;

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

    abstract public function html();
}

?>
