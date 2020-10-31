<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201031020401 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, faith_id INT DEFAULT NULL, faction_id INT DEFAULT NULL, job_id INT DEFAULT NULL, faction_skill_id INT DEFAULT NULL, discarded_skill_id INT DEFAULT NULL, enabled TINYINT(1) NOT NULL, creation_date DATETIME NOT NULL, modification_date DATETIME NOT NULL, mode SMALLINT NOT NULL, name VARCHAR(255) NOT NULL, defect_mode SMALLINT NOT NULL, INDEX IDX_937AB034A76ED395 (user_id), INDEX IDX_937AB0341A5CEA57 (faith_id), INDEX IDX_937AB0344448F8DA (faction_id), INDEX IDX_937AB034BE04EA9 (job_id), INDEX IDX_937AB034D3EA1DF5 (faction_skill_id), INDEX IDX_937AB034B82BD5A2 (discarded_skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_defect (character_id INT NOT NULL, defect_id INT NOT NULL, INDEX IDX_99DEFB141136BE75 (character_id), INDEX IDX_99DEFB146C1DAB9B (defect_id), PRIMARY KEY(character_id, defect_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_attribute (id INT AUTO_INCREMENT NOT NULL, attribute_id INT NOT NULL, character_sheet_id INT NOT NULL, value INT NOT NULL, INDEX IDX_7D2A4DC0B6E62EFA (attribute_id), INDEX IDX_7D2A4DC0D313EF34 (character_sheet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0341A5CEA57 FOREIGN KEY (faith_id) REFERENCES faith (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0344448F8DA FOREIGN KEY (faction_id) REFERENCES faction (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034D3EA1DF5 FOREIGN KEY (faction_skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034B82BD5A2 FOREIGN KEY (discarded_skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE character_defect ADD CONSTRAINT FK_99DEFB141136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_defect ADD CONSTRAINT FK_99DEFB146C1DAB9B FOREIGN KEY (defect_id) REFERENCES defect (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_attribute ADD CONSTRAINT FK_7D2A4DC0B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id)');
        $this->addSql('ALTER TABLE character_attribute ADD CONSTRAINT FK_7D2A4DC0D313EF34 FOREIGN KEY (character_sheet_id) REFERENCES `character` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE character_defect DROP FOREIGN KEY FK_99DEFB141136BE75');
        $this->addSql('ALTER TABLE character_attribute DROP FOREIGN KEY FK_7D2A4DC0D313EF34');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_skill');
        $this->addSql('DROP TABLE character_defect');
        $this->addSql('DROP TABLE character_attribute');
    }
}
