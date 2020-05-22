<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512205631 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nieruchomosc_dodatkowa (nieruchomosc_id INT NOT NULL, dodatkowa_id INT NOT NULL, INDEX IDX_2CCF284BC74FC62D (nieruchomosc_id), INDEX IDX_2CCF284B9D8486A (dodatkowa_id), PRIMARY KEY(nieruchomosc_id, dodatkowa_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nieruchomosc_dodatkowa ADD CONSTRAINT FK_2CCF284BC74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nieruchomosc_dodatkowa ADD CONSTRAINT FK_2CCF284B9D8486A FOREIGN KEY (dodatkowa_id) REFERENCES dodatkowe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE nieruchomosc_dodatkowa');
    }
}
