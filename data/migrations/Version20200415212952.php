<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200415212952 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nieruchomosc_dodatkowe (nieruchomosc_id INT NOT NULL, dodatkowe_id INT NOT NULL, INDEX IDX_2BA2EC52C74FC62D (nieruchomosc_id), INDEX IDX_2BA2EC5286BADF3D (dodatkowe_id), PRIMARY KEY(nieruchomosc_id, dodatkowe_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nieruchomosc_materialy (nieruchomosc_id INT NOT NULL, materialy_id INT NOT NULL, INDEX IDX_FC241117C74FC62D (nieruchomosc_id), INDEX IDX_FC24111755222924 (materialy_id), PRIMARY KEY(nieruchomosc_id, materialy_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nieruchomosc_dodatkowe ADD CONSTRAINT FK_2BA2EC52C74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nieruchomosc_dodatkowe ADD CONSTRAINT FK_2BA2EC5286BADF3D FOREIGN KEY (dodatkowe_id) REFERENCES dodatkowe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nieruchomosc_materialy ADD CONSTRAINT FK_FC241117C74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nieruchomosc_materialy ADD CONSTRAINT FK_FC24111755222924 FOREIGN KEY (materialy_id) REFERENCES materialy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mieszkania ADD liczba_pokoi INT NOT NULL');
        $this->addSql('ALTER TABLE nieruchomosci ADD numer VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dodatkowe DROP FOREIGN KEY FK_AC4402EE9DCD196D');
        $this->addSql('DROP INDEX IDX_AC4402EE9DCD196D ON dodatkowe');
        $this->addSql('ALTER TABLE dodatkowe DROP nieruchomosci_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE nieruchomosc_dodatkowe');
        $this->addSql('DROP TABLE nieruchomosc_materialy');
        $this->addSql('ALTER TABLE dodatkowe ADD nieruchomosci_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dodatkowe ADD CONSTRAINT FK_AC4402EE9DCD196D FOREIGN KEY (nieruchomosci_id) REFERENCES nieruchomosci (id)');
        $this->addSql('CREATE INDEX IDX_AC4402EE9DCD196D ON dodatkowe (nieruchomosci_id)');
        $this->addSql('ALTER TABLE mieszkania DROP liczba_pokoi');
        $this->addSql('ALTER TABLE nieruchomosci DROP numer');
    }
}
