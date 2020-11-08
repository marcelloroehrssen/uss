<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105013923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE downtime ADD down_time_definition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE downtime ADD CONSTRAINT FK_3288FE28BF4F0BE3 FOREIGN KEY (down_time_definition_id) REFERENCES downtime_definition (id)');
        $this->addSql('CREATE INDEX IDX_3288FE28BF4F0BE3 ON downtime (down_time_definition_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE downtime DROP FOREIGN KEY FK_3288FE28BF4F0BE3');
        $this->addSql('DROP INDEX IDX_3288FE28BF4F0BE3 ON downtime');
        $this->addSql('ALTER TABLE downtime DROP down_time_definition_id');
    }
}
