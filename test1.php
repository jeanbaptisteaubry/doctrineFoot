<?php

use App\Entity\Market;
use App\Entity\Stock;

include_once "vendor/autoload.php";
include_once "bootstrap.php";
/*
$market = new Market("NASDAQ");
$entityManager->persist($market);
$entityManager->flush();
echo "Created Product with ID " . $market->getId() . "\n";

$stock = new Stock("AAPL2", $market);
$entityManager->persist($stock);
$entityManager->flush();
*/
$market = $entityManager->getRepository(Market::class)->findOneBy(['name' => 'NASDAQ']);
echo "Found Stock with ID " . $stock->getId() . "\n";

echo "Created Stock with ID " . $stock->getId() . "\n";
