<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201103193239 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventory (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_B12D4A367E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventory_entry (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, inventory_id INT DEFAULT NULL, quantity INT DEFAULT NULL, INDEX IDX_F7BD3670126F525E (item_id), INDEX IDX_F7BD36709EEA759 (inventory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A367E3C61F9 FOREIGN KEY (owner_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE inventory_entry ADD CONSTRAINT FK_F7BD3670126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE inventory_entry ADD CONSTRAINT FK_F7BD36709EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventory_entry DROP FOREIGN KEY FK_F7BD36709EEA759');
        $this->addSql('DROP TABLE inventory');
        $this->addSql('DROP TABLE inventory_entry');
    }
}
