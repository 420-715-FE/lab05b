<?php

require_once('ChampOptions.php');

class ListeDeroulante extends ChampOptions {
    public function __construct($nom, $libelle, $estObligatoire) {
        parent::__construct($nom, $libelle, $estObligatoire);
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
