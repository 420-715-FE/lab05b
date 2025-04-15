<?php

class Formulaire {
    private $titre = "";
    private $champs = [];

    public function __construct($titre) {
        $this->titre = $titre;
    }

    public function ajouterChamp($champ) {
        $this->champs[] = $champ;
    }

    public function estRecu() {
        foreach ($this->champs as $champ) {
            if (!$champ->estRecu()) {
                return false;
            }
        }
        return true;
    }

    public function estValide() {
        foreach ($this->champs as $champ) {
            $champ->valider();
            if ($champ->getErreur()) {
                return false;
            }
        }
        return true;
    }

    public function getChamps() {
        return $this->champs;
    }

    public function html() {
        $html = "<h1>{$this->titre}</h1>";
        $html .= "<form method=\"POST\" action=\"\">";
        
        foreach ($this->champs as $champ) {
            if ($champ->getErreur()) {
                $html .= "<p class=\"erreur\">{$champ->getErreur()}</p>";
            }
            $html .= $champ->html();
        }

        $html .= "<input type=\"submit\" value=\"Envoyer\">";
        $html .= "</form>";

        return $html;
    }
}

?>
