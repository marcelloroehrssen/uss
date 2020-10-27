<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201019235849 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE background ADD count INT NOT NULL');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F85585C142');
        $this->addSql('DROP INDEX IDX_FBD8E0F85585C142 ON job');
        $this->addSql('ALTER TABLE job DROP skill_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE background DROP count');
        $this->addSql('ALTER TABLE job ADD skill_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F85585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F85585C142 ON job (skill_id)');
    }
}
