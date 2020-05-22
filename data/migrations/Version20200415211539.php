<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200415211539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE powiat ADD wojewodztwa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE powiat ADD CONSTRAINT FK_3BE2CBB7DE51DFC6 FOREIGN KEY (wojewodztwa_id) REFERENCES wojewodztwa (id)');
        $this->addSql('CREATE INDEX IDX_3BE2CBB7DE51DFC6 ON powiat (wojewodztwa_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE powiat DROP FOREIGN KEY FK_3BE2CBB7DE51DFC6');
        $this->addSql('DROP INDEX IDX_3BE2CBB7DE51DFC6 ON powiat');
        $this->addSql('ALTER TABLE powiat DROP wojewodztwa_id');
    }
}
