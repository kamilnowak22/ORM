<?php
require_once 'bootstrap.php';
require_once 'header.php';

$em->getConnection()
    ->getConfiguration()
    ->setSQLLogger(new \Doctrine\DBAL\Logging\DebugStack());

if (!isset($_GET['id'])) {
    echo "Brak parametru ID";
    exit();
}

$nieruchomosc = null;
$typ = null;
if ($nieruchomosc == null) {
    $nieruchomosc = $em->getRepository('Entity\Mieszkanie')->pobierzPoNieruchomosci($_GET['id']);
    $typ = 'mieszkanie';
}
if ($nieruchomosc == null) {
    $nieruchomosc = $em->getRepository('Entity\Dom')->pobierzPoNieruchomosci($_GET['id']);
    $typ = 'dom';
}
if ($nieruchomosc == null) {
    $nieruchomosc = $em->getRepository('Entity\Grunt')->pobierzPoNieruchomosci($_GET['id']);
    $typ = 'grunt';
}
if ($nieruchomosc == null) {
    echo "Nie istnieje taka nieruchomość!";
    exit();
}
?>
<?php if ($typ == 'mieszkanie'): ?>
    <h2>Szczegóły mieszkania</h2>
    <p><b>Id</b> : <?= $nieruchomosc->getNieruchomosc()->getId() ?><p>
    <p><b>Typ oferty</b> : <?= $nieruchomosc->getNieruchomosc()->getTypOferty() ?></p>
    <p><b>Lokalizacja</b> : <?= $nieruchomosc->getNieruchomosc()->getMiasto()->getPowiat()->getWojewodztwo()->getNazwa() ?>/<?= $nieruchomosc->getNieruchomosc()->getMiasto()->getPowiat()->getNazwa() ?>/<?= $nieruchomosc->getNieruchomosc()->getMiasto()->getNazwa() ?></p>
    <p><b>Powierzchnia</b> : <?= $nieruchomosc->getNieruchomosc()->getPowierzchnia() ?></p>
    <p><b>Cena</b> : <?= $nieruchomosc->getNieruchomosc()->getCena() ?></p>
    <p><b>Pietro</b> : <?= $nieruchomosc->getPietro() ?>/<?= $nieruchomosc->getLiczbaPieter() ?></p>
    <p><b>Rok budowy</b> : <?= $nieruchomosc->getRokBudowy() ?></p>
    <p><b>Dostepna komunikacja</b> : <?= $nieruchomosc->getNieruchomosc()->pobierzKomunikacje() ?></p>
<?php elseif ($typ == 'dom'): ?>
    <h2>Szczegóły domu</h2>
    <p><b>Id</b> : <?= $nieruchomosc->getNieruchomosc()->getId() ?><p>
    <p><b>Typ oferty</b> : <?= $nieruchomosc->getNieruchomosc()->getTypOferty() ?></p>
    <p><b>Lokalizacja</b> : <?= $nieruchomosc->getNieruchomosc()->getMiasto()->getPowiat()->getWojewodztwo()->getNazwa() ?>/<?= $nieruchomosc->getNieruchomosc()->getMiasto()->getPowiat()->getNazwa() ?>/<?= $nieruchomosc->getNieruchomosc()->getMiasto()->getNazwa() ?></p>
    <p><b>Powierzchnia</b> : <?= $nieruchomosc->getNieruchomosc()->getPowierzchnia() ?></p>
    <p><b>Cena</b> : <?= $nieruchomosc->getNieruchomosc()->getCena() ?></p>
    <p><b>Powierzchnia działki</b> : <?= $nieruchomosc->getPowierzchniaDzialki() ?></p>
    <p><b>Rok budowy</b> : <?= $nieruchomosc->getRokBudowy() ?></p>
    <p><b>Dostepna komunikacja</b> : <?= $nieruchomosc->getNieruchomosc()->pobierzKomunikacje() ?></p>
<?php else: ?>
    <h2>Szczegóły gruntu</h2>
    <p><b>Id</b> : <?= $nieruchomosc->getNieruchomosc()->getId() ?><p>
    <p><b>Typ oferty</b> : <?= $nieruchomosc->getNieruchomosc()->getTypOferty() ?></p>
    <p><b>Lokalizacja</b> : <?= $nieruchomosc->getNieruchomosc()->getMiasto()->getPowiat()->getWojewodztwo()->getNazwa() ?>/<?= $nieruchomosc->getNieruchomosc()->getMiasto()->getPowiat()->getNazwa() ?>/<?= $nieruchomosc->getNieruchomosc()->getMiasto()->getNazwa() ?></p>
    <p><b>Powierzchnia</b> : <?= $nieruchomosc->getNieruchomosc()->getPowierzchnia() ?></p>
    <p><b>Cena</b> : <?= $nieruchomosc->getNieruchomosc()->getCena() ?></p>
    <p><b>Pozwolenie na budowe</b> : <?= $nieruchomosc->getPozwolenieNaBudowe()==1?"TAK":"NIE" ?></p>
    <p><b>Dostepna komunikacja</b> : <?= $nieruchomosc->getNieruchomosc()->pobierzKomunikacje() ?></p>
<?php endif; ?>