<?php

use Entity\Nieruchomosc;

require_once 'bootstrap.php';

$bledy = [];
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

if (!empty($_POST)) {
	// walidacja
	$v = new Valitron\Validator($_POST);
	$v->rule('required', ['typ_oferty', 'powierzchnia', 'cena', 'cena_m2', 'miasto_id']);
	$v->rule('numeric', ['powierzchnia', 'cena', 'cena_m2']);
	$v->rule('min', ['cena', 'cena_m2', 'powierzchnia'], 0);

	if($_POST['typ'] == 'mieszkanie') {
        $v->rule('required', ['pietro', 'liczba_pieter', 'rok_budowy_mieszkanie', 'liczba_pokoi']);
        $v->rule('min', 'rok_budowy_mieszkanie', 1900);
    } else if($_POST['typ'] == 'dom') {
        $v->rule('required', ['powierzchnia_dzialki', 'rok_budowy']);
        $v->rule('min', 'rok_budowy', 1900);
    }

	if ($v->validate()) {
		// ok

		// znajdź miasto
		$miasto = $em->find('Entity\Miasto', $_POST['miasto_id']);

		// zbuduj nieruchomość
		$nieruchomosc->getNieruchomosc()->setTypOferty($_POST['typ_oferty']);
		$nieruchomosc->getNieruchomosc()->setPowierzchnia($_POST['powierzchnia']);
		$nieruchomosc->getNieruchomosc()->setCena($_POST['cena']);
		$nieruchomosc->getNieruchomosc()->setCenaM2($_POST['cena_m2']);
		$nieruchomosc->getNieruchomosc()->setMiasto($miasto);

		$nieruchomosc->getNieruchomosc()->getOpcjekomunikacji()->clear();
		if (!empty($_POST['komunikacja_id'])) {
			foreach ($_POST['komunikacja_id'] as $idk) {
				$komunikacja = $em->find('Entity\Komunikacja', $idk);
				$nieruchomosc->getNieruchomosc()->addOpcjekomunikacji($komunikacja);
			}
		}

		// dodaj mieszkanie
		if($_POST['typ'] == 'mieszkanie') {
            $nieruchomosc->setPietro($_POST['pietro']);
			$nieruchomosc->setLiczbaPieter($_POST['liczba_pieter']);
            $nieruchomosc->setLiczbaPokoi($_POST['liczba_pokoi']);
            $nieruchomosc->setRokBudowy($_POST['rok_budowy_mieszkanie']);
        } else if($_POST['typ'] == 'dom') {
            $nieruchomosc->setPowierzchniaDzialki($_POST['powierzchnia_dzialki']);
            $nieruchomosc->setRokBudowy($_POST['rok_budowy']);
        } else {
            $nieruchomosc->setPozwolenieNaBudowe($_POST['pozwolenie_na_budowe']);
        }
        
		$em->persist($nieruchomosc);
		$em->flush();

		header('Location: index.php');
	} else {
		// błąd
		$bledy = $v->errors();
		var_dump($bledy);
	}
}

$miasta = $em->getRepository('Entity\Miasto')->pobierzSlownik();
$opcjeKomunikacji = $em->getRepository('Entity\Komunikacja')->pobierzSlownik();
$typyOfert = ['S' => 'sprzedaż', 'W' => 'wynajem'];

require_once 'header.php';
?>

<form method="post" action="" class="form">
	<div class="form-group">
		<label>Miasto</label>
		<select name="miasto_id" class="form-control">
			<?php foreach ($miasta as $id => $nazwa) : ?>
				<option value="<?= $id ?>" <?= ($id == ($_POST['miasto_id'] ?? $nieruchomosc->getNieruchomosc()->getMiasto()->getId())) ? 'selected' : '' ?>><?= $nazwa ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label>Typ oferty</label>
		<select name="typ_oferty" class="form-control">
			<?php foreach ($typyOfert as $id => $nazwa) : ?>
				<option value="<?= $id ?>" <?= ($id == ($_POST['typ_oferty'] ?? $nieruchomosc->getNieruchomosc()->getTypOferty())) ? 'selected' : '' ?>><?= $nazwa ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label>Powierzchnia</label>
		<input type="text" name="powierzchnia" value="<?= $_POST['powierzchnia'] ?? $nieruchomosc->getNieruchomosc()->getPowierzchnia() ?>" class="form-control <?= empty($bledy['powierzchnia']) ?: 'is-invalid' ?>" />
		<div class="invalid-feedback"><?= implode('<br>', $bledy['powierzchnia'] ?? []) ?></div>
	</div>
	<div class="form-group">
		<label>Cena</label>
		<input type="text" name="cena" value="<?= $_POST['cena'] ?? $nieruchomosc->getNieruchomosc()->getCena() ?>" class="form-control <?= empty($bledy['cena']) ?: 'is-invalid' ?>" />
		<div class="invalid-feedback"><?= implode('<br>', $bledy['cena'] ?? []) ?></div>
	</div>
	<div class="form-group">
		<label>Cena za m2</label>
		<input type="text" name="cena_m2" value="<?= $_POST['cena_m2'] ?? $nieruchomosc->getNieruchomosc()->getCenaM2() ?>" class="form-control <?= empty($bledy['cena_m2']) ?: 'is-invalid' ?>" />
		<div class="invalid-feedback"><?= implode('<br>', $bledy['cena_m2'] ?? []) ?></div>
	</div>

	<!-- dane mieszkania -->
	<?php if ($typ == 'mieszkanie') : ?>
		<div class="form-group">
			<label>Piętro</label>
			<input type="text" name="pietro" value="<?= $_POST['pietro'] ?? $nieruchomosc->getPietro() ?>" class="form-control <?= empty($bledy['pietro']) ?: 'is-invalid' ?>" />
			<div class="invalid-feedback"><?= implode('<br>', $bledy['pietro'] ?? []) ?></div>
		</div>
		<div class="form-group">
			<label>Liczba pięter</label>
			<input type="text" name="liczba_pieter" value="<?= $_POST['liczba_pieter'] ?? $nieruchomosc->getLiczbaPieter() ?>" class="form-control <?= empty($bledy['liczba_pieter']) ?: 'is-invalid' ?>" />
			<div class="invalid-feedback"><?= implode('<br>', $bledy['liczba_pieter'] ?? []) ?></div>
		</div>
		<div class="form-group">
			<label>Liczba pokoi</label>
			<input type="text" name="liczba_pokoi" value="<?= $_POST['liczba_pokoi'] ?? $nieruchomosc->getLiczbaPieter() ?>" class="form-control <?= empty($bledy['liczba_pokoi']) ?: 'is-invalid' ?>" />
			<div class="invalid-feedback"><?= implode('<br>', $bledy['liczba_pokoi'] ?? []) ?></div>
		</div>
		<div class="form-group">
			<label>Rok budowy</label>
			<input type="text" name="rok_budowy_mieszkanie" value="<?= $_POST['rok_budowy_mieszkanie'] ?? $nieruchomosc->getRokBudowy() ?>" class="form-control <?= empty($bledy['rok_budowy_mieszkanie']) ?: 'is-invalid' ?>" />
			<div class="invalid-feedback"><?= implode('<br>', $bledy['rok_budowy_mieszkanie'] ?? []) ?></div>
		</div>
		<input type="hidden" id="typ" name="typ" value="mieszkanie">
		<!-- dane dom -->
	<?php elseif ($typ == 'dom') : ?>
		<div class="form-group">
			<label>Powierzchnia działki</label>
			<input type="text" name="powierzchnia_dzialki" value="<?= $_POST['powierzchnia_dzialki'] ?? $nieruchomosc->getPowierzchniaDzialki() ?>" class="form-control <?= empty($bledy['powierzchnia_dzialki']) ?: 'is-invalid' ?>" />
			<div class="invalid-feedback"><?= implode('<br>', $bledy['powierzchnia_dzialki'] ?? []) ?></div>
		</div>
		<div class="form-group">
			<label>Rok budowy</label>
			<input type="text" name="rok_budowy" value="<?= $_POST['rok_budowy'] ?? $nieruchomosc->getRokBudowy() ?>" class="form-control <?= empty($bledy['rok_budowy']) ?: 'is-invalid' ?>" />
			<div class="invalid-feedback"><?= implode('<br>', $bledy['rok_budowy'] ?? []) ?></div>
		</div>
		<input type="hidden" id="typ" name="typ" value="dom">
	<?php else : ?>
		<?php
		$checked = false;
		if (isset($_POST['pozwolenie_na_budowe']) && in_array($id, $_POST['pozwolenie_na_budowe'])) {
			$checked = true;
		} elseif (isset($nieruchomosc) && $nieruchomosc->getPozwolenieNaBudowe()) {
			$checked = true;
		}
		?>
		<div class="form-check">
			<input class="form-check-input" type="checkbox" name="pozwolenie_na_budowe" value="1" <?= $checked ? 'checked' : '' ?>>
			<label class="form-check-label">
				Pozwolenie na budowe
			</label>
		</div>
	</br>
		<input type="hidden" id="typ" name="typ" value="grunt">
	<?php endif; ?>
	<div class="form-group">
		<label>Komunikacja</label>
		<?php foreach ($opcjeKomunikacji as $id => $nazwa) : ?>
			<?php
			$checked = false;
			if (isset($_POST['komunikacja_id']) && in_array($id, $_POST['komunikacja_id'])) {
				$checked = true;
			} elseif (isset($nieruchomosc) && $nieruchomosc->getNieruchomosc()->czyOpcjaKomunikacji($id)) {
				$checked = true;
			}
			?>
			<div class="form-check">
				<input class="form-check-input" type="checkbox" name="komunikacja_id[]" value="<?= $id ?>" <?= $checked ? 'checked' : '' ?>>
				<label class="form-check-label">
					<?= $nazwa ?>
				</label>
			</div>
		<?php endforeach; ?>
	</div>
	<button type="submit" class="btn btn-primary">Zapisz</button>
</form>

<?php require_once 'footer.php'; ?>