<?php
include_once "vendor/autoload.php";
include_once "bootstrap.php";

use App\Entity\Equipe;
use App\Entity\Joueur;

$EDF = new Equipe("France");
$entityManager->persist($EDF);
$entityManager->flush();
echo "Equipe " . $EDF->getId() . "\n";

$giroud = new Joueur("Giroud", "Olivier", 18, $EDF);
$entityManager->persist($giroud);
$grizou = new Joueur("Griezmann", "Antoine", 7, $EDF);
$entityManager->persist($grizou);
$entityManager->flush();
echo "Joueur " . $giroud->getId() . "\n";
echo "Joueur " . $grizou->getId() . "\n";

