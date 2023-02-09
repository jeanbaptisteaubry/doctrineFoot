<?php
include_once "vendor/autoload.php";
include_once "bootstrap.php";

use App\Entity\Equipe;
use App\Entity\Joueur;

$joueur = $entityManager->getRepository(Joueur::class)->findOneBy(['nom' => 'Giroud']);

echo "id " . $joueur->getId() . "\n";
echo "nom " . $joueur->getNom() . "\n";
echo "prenom " . $joueur->getPrenom() . "\n";
echo "maillot " . $joueur->getMaillot() . "\n";
echo "equipe " . $joueur->getEquipe()->getDenomination() . "\n";

