<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216162829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_lecon (user_id INTEGER NOT NULL, lecon_id INTEGER NOT NULL, PRIMARY KEY(user_id, lecon_id), CONSTRAINT FK_7624DF76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7624DF76EC1308A5 FOREIGN KEY (lecon_id) REFERENCES lecon (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_7624DF76A76ED395 ON user_lecon (user_id)');
        $this->addSql('CREATE INDEX IDX_7624DF76EC1308A5 ON user_lecon (lecon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_lecon');
    }
}
