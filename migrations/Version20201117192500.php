<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201117192500 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE downtime_definition ADD attribute_id INT DEFAULT NULL, ADD skill_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE downtime_definition ADD CONSTRAINT FK_23C4FB4FB6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id)');
        $this->addSql('ALTER TABLE downtime_definition ADD CONSTRAINT FK_23C4FB4F5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('CREATE INDEX IDX_23C4FB4FB6E62EFA ON downtime_definition (attribute_id)');
        $this->addSql('CREATE INDEX IDX_23C4FB4F5585C142 ON downtime_definition (skill_id)');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E59D8A214');
        $this->addSql('DROP INDEX IDX_1F1B251E59D8A214 ON item');
        $this->addSql('ALTER TABLE item DROP recipe_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE downtime_definition DROP FOREIGN KEY FK_23C4FB4FB6E62EFA');
        $this->addSql('ALTER TABLE downtime_definition DROP FOREIGN KEY FK_23C4FB4F5585C142');
        $this->addSql('DROP INDEX IDX_23C4FB4FB6E62EFA ON downtime_definition');
        $this->addSql('DROP INDEX IDX_23C4FB4F5585C142 ON downtime_definition');
        $this->addSql('ALTER TABLE downtime_definition DROP attribute_id, DROP skill_id');
        $this->addSql('ALTER TABLE item ADD recipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E59D8A214 ON item (recipe_id)');
    }
}
