<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201010140606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banner RENAME COLUMN path TO filename');
        $this->addSql('ALTER TABLE client RENAME COLUMN homepage TO url');
        $this->addSql('ALTER TABLE client RENAME COLUMN image TO filename');
        $this->addSql('ALTER TABLE profile_image RENAME COLUMN image TO filename');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE banner RENAME COLUMN filename TO path');
        $this->addSql('ALTER TABLE client RENAME COLUMN url TO homepage');
        $this->addSql('ALTER TABLE client RENAME COLUMN filename TO image');
        $this->addSql('ALTER TABLE profile_image RENAME COLUMN filename TO image');
    }
}
