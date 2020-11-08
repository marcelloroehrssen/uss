<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201104162935 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE downtime_definition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, note LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE downtime_definition_item (downtime_definition_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_E1F542C676C63131 (downtime_definition_id), INDEX IDX_E1F542C6126F525E (item_id), PRIMARY KEY(downtime_definition_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE downtime_definition_item ADD CONSTRAINT FK_E1F542C676C63131 FOREIGN KEY (downtime_definition_id) REFERENCES downtime_definition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE downtime_definition_item ADD CONSTRAINT FK_E1F542C6126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE downtime_definition_item DROP FOREIGN KEY FK_E1F542C676C63131');
        $this->addSql('DROP TABLE downtime_definition');
        $this->addSql('DROP TABLE downtime_definition_item');
    }
}
