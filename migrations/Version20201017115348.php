<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201017115348 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill_group_skill (skill_group_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_B00F56DCBCFCB4B5 (skill_group_id), INDEX IDX_B00F56DC5585C142 (skill_id), PRIMARY KEY(skill_group_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE skill_group_skill ADD CONSTRAINT FK_B00F56DCBCFCB4B5 FOREIGN KEY (skill_group_id) REFERENCES skill_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_group_skill ADD CONSTRAINT FK_B00F56DC5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE skill_group_skill');
    }
}
