<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424130719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE frais ADD user_id INT NOT NULL, CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C98A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_25404C98A76ED395 ON frais (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C98A76ED395');
        $this->addSql('DROP INDEX IDX_25404C98A76ED395 ON frais');
        $this->addSql('ALTER TABLE frais DROP user_id, CHANGE status status VARCHAR(255) DEFAULT NULL');
    }
}
