<?php
require_once 'bootstrap.php';
require_once 'header.php';

$em->getConnection()
  ->getConfiguration()
  ->setSQLLogger(new \Doctrine\DBAL\Logging\DebugStack())
;

if(!isset($_GET['typ'])) {
    echo "Brak parametru TYP";
    exit();
}

if($_GET['typ']=='mieszkania') {
    $mieszkania = $em->getRepository('Entity\Mieszkanie')->pobierzWszystko();
} else if($_GET['typ']=='domy') {
    $domy = $em->getRepository('Entity\Dom')->pobierzWszystko();
} else {
    $grunty = $em->getRepository('Entity\Grunt')->pobierzWszystko();
}
?>

<?php if($_GET['typ']=='mieszkania') { ?>
<table class="table table-stripped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Typ</th>
            <th>Lokalizacja</th>
            <th>Powierzchnia</th>
            <th>Cena</th>
            <th>Piętro</th>
            <th>Rok budowy</th>
            <th>Komunikacja</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mieszkania as $miesz): ?>
            <tr>
                <td><?= $miesz->getNieruchomosc()->getId() ?></td>
                <td><?= $miesz->getNieruchomosc()->getTypOferty() ?></td>
                <td><?= $miesz->getNieruchomosc()->getMiasto()->getPowiat()->getWojewodztwo()->getNazwa() ?>/<?= $miesz->getNieruchomosc()->getMiasto()->getPowiat()->getNazwa() ?>/<?= $miesz->getNieruchomosc()->getMiasto()->getNazwa() ?></td>
                <td><?= $miesz->getNieruchomosc()->getPowierzchnia() ?></td>
                <td><?= $miesz->getNieruchomosc()->getCena() ?></td>
                <td><?= $miesz->getPietro() ?>/<?= $miesz->getLiczbaPieter() ?></td>
                <td><?= $miesz->getRokBudowy() ?></td>
                <td><?= $miesz->getNieruchomosc()->pobierzKomunikacje() ?></td>
                <td>
                    <a href="nieruchomosci.szczegoly.php?id=<?= $miesz->getNieruchomosc()->getId() ?>">szczegóły</a> |
                    <a href="nieruchomosci.edycja.php?id=<?= $miesz->getNieruchomosc()->getId() ?>">edycja</a> |
                    <a href="nieruchomosci.usun.php?id=<?= $miesz->getNieruchomosc()->getId() ?>">usuń</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php } else if($_GET['typ']=='domy') { ?>
    <table class="table table-stripped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Typ</th>
            <th>Lokalizacja</th>
            <th>Powierzchnia</th>
            <th>Cena</th>
            <th>Powierzchnia działki</th>
            <th>Rok budowy</th>
            <th>Komunikacja</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($domy as $dom): ?>
            <tr>
                <td><?= $dom->getNieruchomosc()->getId() ?></td>
                <td><?= $dom->getNieruchomosc()->getTypOferty() ?></td>
                <td><?= $dom->getNieruchomosc()->getMiasto()->getPowiat()->getWojewodztwo()->getNazwa() ?>/<?= $dom->getNieruchomosc()->getMiasto()->getPowiat()->getNazwa() ?>/<?= $dom->getNieruchomosc()->getMiasto()->getNazwa() ?></td>
                <td><?= $dom->getNieruchomosc()->getPowierzchnia() ?></td>
                <td><?= $dom->getNieruchomosc()->getCena() ?></td>
                <td><?= $dom->getPowierzchniaDzialki()?></td>
                <td><?= $dom->getRokBudowy() ?></td>
                <td><?= $dom->getNieruchomosc()->pobierzKomunikacje() ?></td>
                <td>
                    <a href="nieruchomosci.szczegoly.php?id=<?= $dom->getNieruchomosc()->getId() ?>">szczegóły</a> |
                    <a href="nieruchomosci.edycja.php?id=<?= $dom->getNieruchomosc()->getId() ?>">edycja</a> |
                    <a href="nieruchomosci.usun.php?id=<?= $dom->getNieruchomosc()->getId() ?>">usuń</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php } else { ?>
<table class="table table-stripped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Typ</th>
            <th>Lokalizacja</th>
            <th>Powierzchnia</th>
            <th>Cena</th>
            <th>Pozwolenie na budowe</th>
            <th>Komunikacja</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($grunty as $grunt): ?>
            <tr>
                <td><?= $grunt->getNieruchomosc()->getId() ?></td>
                <td><?= $grunt->getNieruchomosc()->getTypOferty() ?></td>
                <td><?= $grunt->getNieruchomosc()->getMiasto()->getPowiat()->getWojewodztwo()->getNazwa() ?>/<?= $grunt->getNieruchomosc()->getMiasto()->getPowiat()->getNazwa() ?>/<?= $grunt->getNieruchomosc()->getMiasto()->getNazwa() ?></td>
                <td><?= $grunt->getNieruchomosc()->getPowierzchnia() ?></td>
                <td><?= $grunt->getNieruchomosc()->getCena() ?></td>
                <td><?= $grunt->getPozwolenieNaBudowe() ?></td>
                <td><?= $grunt->getNieruchomosc()->pobierzKomunikacje() ?></td>
                <td>
                    <a href="nieruchomosci.szczegoly.php?id=<?= $grunt->getNieruchomosc()->getId() ?>">szczegóły</a> |
                    <a href="nieruchomosci.edycja.php?id=<?= $grunt->getNieruchomosc()->getId() ?>">edycja</a> |
                    <a href="nieruchomosci.usun.php?id=<?= $grunt->getNieruchomosc()->getId() ?>">usuń</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php } ?>  

<? require_once 'footer.php'; ?>

<?php $logger = $em->getConnection()->getConfiguration()->getSQLLogger(); ?>
<ul>
<?php foreach($logger->queries as $i => $q): ?>
    <li>
        <strong>#<?=$i ?></strong>
        <?=$q['sql'] ?>
    </li>
<?php endforeach; ?>
</ul>