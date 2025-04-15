<?php

require_once('classes/ChampTexte.php');
require_once('classes/ChampNombre.php');
require_once('classes/ListeDeroulante.php');

$champAge = new ChampNombre('age', 'Âge', false, true);
$champAge->setValeurMin(0);
$champAge->setValeurMax(120);

$champProvince = new ListeDeroulante('province', 'Province / Territoire', true);
$champProvince->ajouterOption('Alberta');
$champProvince->ajouterOption('Colombie-Britannique');
$champProvince->ajouterOption('Île-du-Prince-Édouard');
$champProvince->ajouterOption('Manitoba');
$champProvince->ajouterOption('Nouveau-Brunswick');
$champProvince->ajouterOption('Nouvelle-Écosse');
$champProvince->ajouterOption('Nunavut');
$champProvince->ajouterOption('Ontario');
$champProvince->ajouterOption('Québec');
$champProvince->ajouterOption('Saskatchewan');
$champProvince->ajouterOption('Terre-Neuve-et-Labrador');
$champProvince->ajouterOption('Territoires du Nord-Ouest');
$champProvince->ajouterOption('Yukon');

$champs = [
    new ChampTexte('prenom', 'Prénom', true),
    new ChampTexte('nom', 'Nom', true),
    new ChampTexte('courriel', 'Adresse courriel', true),
    new ChampTexte('telephone', 'Téléphone', false),
    $champAge,
    $champProvince
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
