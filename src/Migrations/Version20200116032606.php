<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116032606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE watch_list ADD usr_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE watch_list ADD movie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE watch_list ADD CONSTRAINT FK_152B584BC69D3FB FOREIGN KEY (usr_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE watch_list ADD CONSTRAINT FK_152B584B8F93B6FC FOREIGN KEY (movie_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_152B584BC69D3FB ON watch_list (usr_id)');
        $this->addSql('CREATE INDEX IDX_152B584B8F93B6FC ON watch_list (movie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE watch_list DROP CONSTRAINT FK_152B584BC69D3FB');
        $this->addSql('ALTER TABLE watch_list DROP CONSTRAINT FK_152B584B8F93B6FC');
        $this->addSql('DROP INDEX IDX_152B584BC69D3FB');
        $this->addSql('DROP INDEX IDX_152B584B8F93B6FC');
        $this->addSql('ALTER TABLE watch_list DROP usr_id');
        $this->addSql('ALTER TABLE watch_list DROP movie_id');
    }
}
