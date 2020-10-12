<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201011101149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience RENAME COLUMN company_url TO url');
        $this->addSql('ALTER TABLE project ADD filename VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE project DROP image_path');
        $this->addSql('ALTER TABLE project DROP thumbnail');
        $this->addSql('ALTER TABLE project DROP image');
        $this->addSql('ALTER TABLE service RENAME COLUMN image TO filename');
        $this->addSql('ALTER TABLE service_section RENAME COLUMN image TO filename');
        $this->addSql('ALTER TABLE stack RENAME COLUMN logo TO filename');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE experience RENAME COLUMN url TO company_url');
        $this->addSql('ALTER TABLE stack RENAME COLUMN filename TO logo');
        $this->addSql('ALTER TABLE project ADD thumbnail VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE project RENAME COLUMN filename TO image_path');
        $this->addSql('ALTER TABLE service RENAME COLUMN filename TO image');
        $this->addSql('ALTER TABLE service_section RENAME COLUMN filename TO image');
    }
}
