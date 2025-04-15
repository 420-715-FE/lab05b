<?php

require_once('classes/ChampTexte.php');

$champs = [
    new ChampTexte('prenom', 'Prénom', true),
    new ChampTexte('nom', 'Nom', true),
    new ChampTexte('courriel', 'Adresse courriel', true),
    new ChampTexte('telephone', 'Téléphone', false)
];

$erreurs = false;
if ($champs[0]->estRecu()) {
    foreach ($champs as $champ) {
        $champ->valider();
        if ($champ->getErreur() !== null) {
            $erreurs = true;
        }
    }
}

if (!$champs[0]->estRecu() || $erreurs) {
    echo "<h1>Formulaire d'inscription</h1>";
    echo '<form method="post">';
    foreach ($champs as $champ) {
        if ($champ->getErreur() !== null) {
            echo "<p>{$champ->getErreur()}</p>";
        }
    }
    foreach ($champs as $champ) {
        echo $champ->html();
    }
    echo '<input type="submit" value="Soumettre">';
    echo '</form>';
} else {
    echo "<h1>Formulaire soumis avec succès</h1>";
    foreach ($champs as $champ) {
        echo "<p>{$champ->getLibelle()}: {$champ->getValeur()}</p>";
    }
    echo '<a href="">Retour</a>';
}

?>
