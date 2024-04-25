<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240425081631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_frais ADD frais_id INT NOT NULL');
        $this->addSql('ALTER TABLE liste_frais ADD CONSTRAINT FK_3ABB9836BF516DC4 FOREIGN KEY (frais_id) REFERENCES frais (id)');
        $this->addSql('CREATE INDEX IDX_3ABB9836BF516DC4 ON liste_frais (frais_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_frais DROP FOREIGN KEY FK_3ABB9836BF516DC4');
        $this->addSql('DROP INDEX IDX_3ABB9836BF516DC4 ON liste_frais');
        $this->addSql('ALTER TABLE liste_frais DROP frais_id');
    }
}
