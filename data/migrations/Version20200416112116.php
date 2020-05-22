<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200416112116 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dodatkowe (id INT AUTO_INCREMENT NOT NULL, nieruchomosc_id INT DEFAULT NULL, nazwa VARCHAR(255) NOT NULL, INDEX IDX_AC4402EEC74FC62D (nieruchomosc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domy (id INT AUTO_INCREMENT NOT NULL, nieruchomosc_id INT DEFAULT NULL, powierzchnia_dzialki DOUBLE PRECISION NOT NULL, rok_budowy INT NOT NULL, UNIQUE INDEX UNIQ_2F01EF27C74FC62D (nieruchomosc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grunty (id INT AUTO_INCREMENT NOT NULL, nieruchomosc_id INT DEFAULT NULL, pozwolenie_na_budowe TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_5B03EE00C74FC62D (nieruchomosc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materialy (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nieruchomosc_komunikacja (nieruchomosc_id INT NOT NULL, komunikacja_id INT NOT NULL, INDEX IDX_8FCB7CDC74FC62D (nieruchomosc_id), INDEX IDX_8FCB7CDDA8337E3 (komunikacja_id), PRIMARY KEY(nieruchomosc_id, komunikacja_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nieruchomosc_material (nieruchomosc_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_92F31B04C74FC62D (nieruchomosc_id), INDEX IDX_92F31B04E308AC6F (material_id), PRIMARY KEY(nieruchomosc_id, material_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE powiaty (id INT AUTO_INCREMENT NOT NULL, wojewodztwo_id INT DEFAULT NULL, nazwa VARCHAR(255) NOT NULL, INDEX IDX_AEE5E2F13E8EA8F5 (wojewodztwo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wojewodztwa (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dodatkowe ADD CONSTRAINT FK_AC4402EEC74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id)');
        $this->addSql('ALTER TABLE domy ADD CONSTRAINT FK_2F01EF27C74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id)');
        $this->addSql('ALTER TABLE grunty ADD CONSTRAINT FK_5B03EE00C74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id)');
        $this->addSql('ALTER TABLE nieruchomosc_komunikacja ADD CONSTRAINT FK_8FCB7CDC74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nieruchomosc_komunikacja ADD CONSTRAINT FK_8FCB7CDDA8337E3 FOREIGN KEY (komunikacja_id) REFERENCES komunikacja (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nieruchomosc_material ADD CONSTRAINT FK_92F31B04C74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nieruchomosc_material ADD CONSTRAINT FK_92F31B04E308AC6F FOREIGN KEY (material_id) REFERENCES materialy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE powiaty ADD CONSTRAINT FK_AEE5E2F13E8EA8F5 FOREIGN KEY (wojewodztwo_id) REFERENCES wojewodztwa (id)');
        $this->addSql('DROP TABLE nieruchomosci_komunikacja');
        $this->addSql('ALTER TABLE miasta ADD powiat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE miasta ADD CONSTRAINT FK_35410348C05AA04F FOREIGN KEY (powiat_id) REFERENCES powiaty (id)');
        $this->addSql('CREATE INDEX IDX_35410348C05AA04F ON miasta (powiat_id)');
        $this->addSql('ALTER TABLE mieszkania ADD liczba_pokoi INT NOT NULL');
        $this->addSql('ALTER TABLE nieruchomosci ADD numer VARCHAR(30) NOT NULL, CHANGE typ_oferty typ_oferty VARCHAR(8) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nieruchomosc_material DROP FOREIGN KEY FK_92F31B04E308AC6F');
        $this->addSql('ALTER TABLE miasta DROP FOREIGN KEY FK_35410348C05AA04F');
        $this->addSql('ALTER TABLE powiaty DROP FOREIGN KEY FK_AEE5E2F13E8EA8F5');
        $this->addSql('CREATE TABLE nieruchomosci_komunikacja (nieruchomosc_id INT NOT NULL, komunikacja_id INT NOT NULL, INDEX IDX_BBCF0030DA8337E3 (komunikacja_id), INDEX IDX_BBCF0030C74FC62D (nieruchomosc_id), PRIMARY KEY(nieruchomosc_id, komunikacja_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE nieruchomosci_komunikacja ADD CONSTRAINT FK_BBCF0030C74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id)');
        $this->addSql('ALTER TABLE nieruchomosci_komunikacja ADD CONSTRAINT FK_BBCF0030DA8337E3 FOREIGN KEY (komunikacja_id) REFERENCES komunikacja (id)');
        $this->addSql('DROP TABLE dodatkowe');
        $this->addSql('DROP TABLE domy');
        $this->addSql('DROP TABLE grunty');
        $this->addSql('DROP TABLE materialy');
        $this->addSql('DROP TABLE nieruchomosc_komunikacja');
        $this->addSql('DROP TABLE nieruchomosc_material');
        $this->addSql('DROP TABLE powiaty');
        $this->addSql('DROP TABLE wojewodztwa');
        $this->addSql('DROP INDEX IDX_35410348C05AA04F ON miasta');
        $this->addSql('ALTER TABLE miasta DROP powiat_id');
        $this->addSql('ALTER TABLE mieszkania DROP liczba_pokoi');
        $this->addSql('ALTER TABLE nieruchomosci DROP numer, CHANGE typ_oferty typ_oferty VARCHAR(5) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`');
    }
}
