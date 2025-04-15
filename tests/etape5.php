<?php

require_once('classes/ChampTexte.php');
require_once('classes/ChampNombre.php');
require_once('classes/ListeDeroulante.php');
require_once('classes/GroupeBoutonsRadio.php');
require_once('classes/Formulaire.php');

$formulaire = new Formulaire("Formulaire d'inscription");

$formulaire->ajouterChamp(new ChampTexte('prenom', 'Prénom', true));
$formulaire->ajouterChamp(new ChampTexte('nom', 'Nom', true));
$formulaire->ajouterChamp(new ChampTexte('courriel', 'Adresse courriel', true));
$formulaire->ajouterChamp(new ChampTexte('telephone', 'Téléphone', false));

$champAge = new ChampNombre('age', 'Âge', false, true);
$champAge->setValeurMin(0);
$champAge->setValeurMax(120);
$formulaire->ajouterChamp($champAge);

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
$formulaire->ajouterChamp($champProvince);

$champTypeInscription = new GroupeBoutonsRadio('typeInscription', 'Type d\'inscription', true);
$champTypeInscription->ajouterOption('Individuelle');
$champTypeInscription->ajouterOption('Familliale');
$formulaire->ajouterChamp($champTypeInscription);

if ($formulaire->estRecu() && $formulaire->estValide()) {
    echo "<h1>Formulaire soumis avec succès</h1>";
    foreach ($formulaire->getChamps() as $champ) {
        echo "<p>{$champ->getLibelle()}: {$champ->getValeur()}</p>";
    }
    echo '<a href="">Retour</a>';   
} else {
    echo $formulaire->html(); 
}

?>
