<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201104170109 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE downtime (id INT AUTO_INCREMENT NOT NULL, character_sheet_id INT NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_3288FE28D313EF34 (character_sheet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE downtime ADD CONSTRAINT FK_3288FE28D313EF34 FOREIGN KEY (character_sheet_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE inventory_entry ADD downtime_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory_entry ADD CONSTRAINT FK_F7BD36703943157B FOREIGN KEY (downtime_id) REFERENCES downtime (id)');
        $this->addSql('CREATE INDEX IDX_F7BD36703943157B ON inventory_entry (downtime_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventory_entry DROP FOREIGN KEY FK_F7BD36703943157B');
        $this->addSql('DROP TABLE downtime');
        $this->addSql('DROP INDEX IDX_F7BD36703943157B ON inventory_entry');
        $this->addSql('ALTER TABLE inventory_entry DROP downtime_id');
    }
}
