<?php

require_once('ChampOptions.php');

class GroupeBoutonsRadio extends ChampOptions {
    public function __construct($nom, $libelle, $estObligatoire) {
        parent::__construct($nom, $libelle, $estObligatoire);
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
