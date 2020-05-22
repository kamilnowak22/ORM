<?php
require_once 'bootstrap.php';
require_once 'header.php';
use Entity\Nieruchomosc;

$nieruchomosc = $em->getReference('Entity\Nieruchomosc', $_GET['id']);
$em->remove($nieruchomosc);
$em->flush();

header('location:index.php');