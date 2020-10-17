<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201017112911 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, requisite_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cite LONGTEXT NOT NULL, INDEX IDX_FBD8E0F895EDF9EA (requisite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_skill (job_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_5F615907BE04EA9 (job_id), INDEX IDX_5F6159075585C142 (skill_id), PRIMARY KEY(job_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, requisite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_group (id INT AUTO_INCREMENT NOT NULL, job_id INT NOT NULL, count INT NOT NULL, INDEX IDX_48E8D7F9BE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F895EDF9EA FOREIGN KEY (requisite_id) REFERENCES job_type (id)');
        $this->addSql('ALTER TABLE job_skill ADD CONSTRAINT FK_5F615907BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_skill ADD CONSTRAINT FK_5F6159075585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_group ADD CONSTRAINT FK_48E8D7F9BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_skill DROP FOREIGN KEY FK_5F615907BE04EA9');
        $this->addSql('ALTER TABLE skill_group DROP FOREIGN KEY FK_48E8D7F9BE04EA9');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F895EDF9EA');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE job_skill');
        $this->addSql('DROP TABLE job_type');
        $this->addSql('DROP TABLE skill_group');
    }
}
