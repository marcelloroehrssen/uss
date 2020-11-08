<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201107005752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE downtime ADD story_teller_id INT DEFAULT NULL, ADD resolution LONGTEXT DEFAULT NULL, ADD resolution_time DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE downtime ADD CONSTRAINT FK_3288FE2810337761 FOREIGN KEY (story_teller_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3288FE2810337761 ON downtime (story_teller_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE downtime DROP FOREIGN KEY FK_3288FE2810337761');
        $this->addSql('DROP INDEX IDX_3288FE2810337761 ON downtime');
        $this->addSql('ALTER TABLE downtime DROP story_teller_id, DROP resolution, DROP resolution_time');
    }
}
