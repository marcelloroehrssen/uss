<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201031023206 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE character_background (id INT AUTO_INCREMENT NOT NULL, character_sheet_id INT DEFAULT NULL, background_id INT DEFAULT NULL, value INT NOT NULL, INDEX IDX_DE40DD6D313EF34 (character_sheet_id), INDEX IDX_DE40DD6C93D69EA (background_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_skill (id INT AUTO_INCREMENT NOT NULL, character_sheet_id INT DEFAULT NULL, skill_id INT DEFAULT NULL, value INT NOT NULL, INDEX IDX_F3ECAA51D313EF34 (character_sheet_id), INDEX IDX_F3ECAA515585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_background ADD CONSTRAINT FK_DE40DD6D313EF34 FOREIGN KEY (character_sheet_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE character_background ADD CONSTRAINT FK_DE40DD6C93D69EA FOREIGN KEY (background_id) REFERENCES background (id)');
        $this->addSql('ALTER TABLE character_skill_selected ADD CONSTRAINT FK_F3ECAA51D313EF34 FOREIGN KEY (character_sheet_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE character_skill_selected ADD CONSTRAINT FK_F3ECAA515585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE character_background');
        $this->addSql('DROP TABLE character_skill_selected');
    }
}
