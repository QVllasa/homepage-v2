<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201005164227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE service_section_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE service_section (id INT NOT NULL, service_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, keys TEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E2F72873ED5CA9E6 ON service_section (service_id)');
        $this->addSql('COMMENT ON COLUMN service_section.keys IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE service_section ADD CONSTRAINT FK_E2F72873ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service DROP keys');
        $this->addSql('ALTER TABLE service ALTER icon DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE service_section_id_seq CASCADE');
        $this->addSql('DROP TABLE service_section');
        $this->addSql('ALTER TABLE service ADD keys TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ALTER icon SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN service.keys IS \'(DC2Type:array)\'');
    }
}
