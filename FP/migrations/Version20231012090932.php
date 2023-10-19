<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231012090932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD autheurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331A505C0D0 FOREIGN KEY (autheurs_id) REFERENCES auteur (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331A505C0D0 ON book (autheurs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331A505C0D0');
        $this->addSql('DROP INDEX IDX_CBE5A331A505C0D0 ON book');
        $this->addSql('ALTER TABLE book DROP autheurs_id');
    }
}
