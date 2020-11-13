<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201113214250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, faith_id INT DEFAULT NULL, faction_id INT DEFAULT NULL, job_id INT DEFAULT NULL, faction_skill_id INT DEFAULT NULL, discarded_skill_id INT DEFAULT NULL, enabled TINYINT(1) NOT NULL, type SMALLINT NOT NULL, creation_date DATETIME NOT NULL, modification_date DATETIME NOT NULL, mode SMALLINT NOT NULL, name VARCHAR(255) NOT NULL, defect_mode SMALLINT NOT NULL, INDEX IDX_937AB034A76ED395 (user_id), INDEX IDX_937AB0341A5CEA57 (faith_id), INDEX IDX_937AB0344448F8DA (faction_id), INDEX IDX_937AB034BE04EA9 (job_id), INDEX IDX_937AB034D3EA1DF5 (faction_skill_id), INDEX IDX_937AB034B82BD5A2 (discarded_skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE character_skill (character_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_A0FE03151136BE75 (character_id), INDEX IDX_A0FE03155585C142 (skill_id), PRIMARY KEY(character_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE character_defect (character_id INT NOT NULL, defect_id INT NOT NULL, INDEX IDX_99DEFB141136BE75 (character_id), INDEX IDX_99DEFB146C1DAB9B (defect_id), PRIMARY KEY(character_id, defect_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE character_attribute (id INT AUTO_INCREMENT NOT NULL, attribute_id INT NOT NULL, character_sheet_id INT NOT NULL, value INT NOT NULL, INDEX IDX_7D2A4DC0B6E62EFA (attribute_id), INDEX IDX_7D2A4DC0D313EF34 (character_sheet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE character_background (id INT AUTO_INCREMENT NOT NULL, character_sheet_id INT DEFAULT NULL, background_id INT DEFAULT NULL, value INT NOT NULL, INDEX IDX_DE40DD6D313EF34 (character_sheet_id), INDEX IDX_DE40DD6C93D69EA (background_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE character_skill_selected (id INT AUTO_INCREMENT NOT NULL, character_sheet_id INT DEFAULT NULL, skill_id INT DEFAULT NULL, value INT NOT NULL, INDEX IDX_F3ECAA51D313EF34 (character_sheet_id), INDEX IDX_F3ECAA515585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, downtime_id INT DEFAULT NULL, created_at DATETIME NOT NULL, text LONGTEXT NOT NULL, relatedTo VARCHAR(255) NOT NULL, INDEX IDX_9474526CF675F31B (author_id), INDEX IDX_9474526C3943157B (downtime_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE downtime (id INT AUTO_INCREMENT NOT NULL, character_sheet_id INT NOT NULL, down_time_definition_id INT DEFAULT NULL, story_teller_id INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, name VARCHAR(255) NOT NULL, resolution LONGTEXT DEFAULT NULL, resolution_time DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_3288FE28D313EF34 (character_sheet_id), INDEX IDX_3288FE28BF4F0BE3 (down_time_definition_id), INDEX IDX_3288FE2810337761 (story_teller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE downtime_definition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, note LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE downtime_definition_item (downtime_definition_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_E1F542C676C63131 (downtime_definition_id), INDEX IDX_E1F542C6126F525E (item_id), PRIMARY KEY(downtime_definition_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE inventory (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, is_public TINYINT(1) NOT NULL, INDEX IDX_B12D4A367E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE inventory_entry (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, inventory_id INT DEFAULT NULL, downtime_id INT DEFAULT NULL, quantity INT DEFAULT NULL, INDEX IDX_F7BD3670126F525E (item_id), INDEX IDX_F7BD36709EEA759 (inventory_id), INDEX IDX_F7BD36703943157B (downtime_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, is_consumable TINYINT(1) NOT NULL, image VARCHAR(255) DEFAULT NULL, uploaded_at DATETIME NOT NULL, cost INT NOT NULL, enabled TINYINT(1) NOT NULL, dots INT NOT NULL, value INT NOT NULL, type VARCHAR(255) NOT NULL, max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A76ED395 FOREIGN KEY (user_id) REFERENCES user (id);');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0341A5CEA57 FOREIGN KEY (faith_id) REFERENCES faith (id);');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0344448F8DA FOREIGN KEY (faction_id) REFERENCES faction (id);');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id);');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034D3EA1DF5 FOREIGN KEY (faction_skill_id) REFERENCES skill (id);');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034B82BD5A2 FOREIGN KEY (discarded_skill_id) REFERENCES skill (id);');
        $this->addSql('ALTER TABLE character_skill ADD CONSTRAINT FK_A0FE03151136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE character_skill ADD CONSTRAINT FK_A0FE03155585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE character_defect ADD CONSTRAINT FK_99DEFB141136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE character_defect ADD CONSTRAINT FK_99DEFB146C1DAB9B FOREIGN KEY (defect_id) REFERENCES defect (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE character_attribute ADD CONSTRAINT FK_7D2A4DC0B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id);');
        $this->addSql('ALTER TABLE character_attribute ADD CONSTRAINT FK_7D2A4DC0D313EF34 FOREIGN KEY (character_sheet_id) REFERENCES `character` (id);');
        $this->addSql('ALTER TABLE character_background ADD CONSTRAINT FK_DE40DD6D313EF34 FOREIGN KEY (character_sheet_id) REFERENCES `character` (id);');
        $this->addSql('ALTER TABLE character_background ADD CONSTRAINT FK_DE40DD6C93D69EA FOREIGN KEY (background_id) REFERENCES background (id);');
        $this->addSql('ALTER TABLE character_skill_selected ADD CONSTRAINT FK_F3ECAA51D313EF34 FOREIGN KEY (character_sheet_id) REFERENCES `character` (id);');
        $this->addSql('ALTER TABLE character_skill_selected ADD CONSTRAINT FK_F3ECAA515585C142 FOREIGN KEY (skill_id) REFERENCES skill (id);');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id);');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C3943157B FOREIGN KEY (downtime_id) REFERENCES downtime (id);');
        $this->addSql('ALTER TABLE downtime ADD CONSTRAINT FK_3288FE28D313EF34 FOREIGN KEY (character_sheet_id) REFERENCES `character` (id);');
        $this->addSql('ALTER TABLE downtime ADD CONSTRAINT FK_3288FE28BF4F0BE3 FOREIGN KEY (down_time_definition_id) REFERENCES downtime_definition (id);');
        $this->addSql('ALTER TABLE downtime ADD CONSTRAINT FK_3288FE2810337761 FOREIGN KEY (story_teller_id) REFERENCES user (id);');
        $this->addSql('ALTER TABLE downtime_definition_item ADD CONSTRAINT FK_E1F542C676C63131 FOREIGN KEY (downtime_definition_id) REFERENCES downtime_definition (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE downtime_definition_item ADD CONSTRAINT FK_E1F542C6126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A367E3C61F9 FOREIGN KEY (owner_id) REFERENCES `character` (id);');
        $this->addSql('ALTER TABLE inventory_entry ADD CONSTRAINT FK_F7BD3670126F525E FOREIGN KEY (item_id) REFERENCES item (id);');
        $this->addSql('ALTER TABLE inventory_entry ADD CONSTRAINT FK_F7BD36709EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id);');
        $this->addSql('ALTER TABLE inventory_entry ADD CONSTRAINT FK_F7BD36703943157B FOREIGN KEY (downtime_id) REFERENCES downtime (id) ON DELETE SET NULL;');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL;');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE character_skill DROP FOREIGN KEY FK_A0FE03151136BE75');
        $this->addSql('ALTER TABLE character_defect DROP FOREIGN KEY FK_99DEFB141136BE75');
        $this->addSql('ALTER TABLE character_attribute DROP FOREIGN KEY FK_7D2A4DC0D313EF34');
        $this->addSql('ALTER TABLE character_background DROP FOREIGN KEY FK_DE40DD6D313EF34');
        $this->addSql('ALTER TABLE character_skill_selected DROP FOREIGN KEY FK_F3ECAA51D313EF34');
        $this->addSql('ALTER TABLE downtime DROP FOREIGN KEY FK_3288FE28D313EF34');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A367E3C61F9');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C3943157B');
        $this->addSql('ALTER TABLE inventory_entry DROP FOREIGN KEY FK_F7BD36703943157B');
        $this->addSql('ALTER TABLE downtime DROP FOREIGN KEY FK_3288FE28BF4F0BE3');
        $this->addSql('ALTER TABLE downtime_definition_item DROP FOREIGN KEY FK_E1F542C676C63131');
        $this->addSql('ALTER TABLE inventory_entry DROP FOREIGN KEY FK_F7BD36709EEA759');
        $this->addSql('ALTER TABLE downtime_definition_item DROP FOREIGN KEY FK_E1F542C6126F525E');
        $this->addSql('ALTER TABLE inventory_entry DROP FOREIGN KEY FK_F7BD3670126F525E');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_skill');
        $this->addSql('DROP TABLE character_defect');
        $this->addSql('DROP TABLE character_attribute');
        $this->addSql('DROP TABLE character_background');
        $this->addSql('DROP TABLE character_skill_selected');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE downtime');
        $this->addSql('DROP TABLE downtime_definition');
        $this->addSql('DROP TABLE downtime_definition_item');
        $this->addSql('DROP TABLE inventory');
        $this->addSql('DROP TABLE inventory_entry');
        $this->addSql('DROP TABLE item');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
