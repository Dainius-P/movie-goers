<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114161507 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE movie_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE watch_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE watch_list (id INT NOT NULL, movie_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, owner_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE movie');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE watch_list_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE movie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE movie (id INT NOT NULL, pavadinimas VARCHAR(255) NOT NULL, isleidimo_data DATE DEFAULT NULL, ivercio_vidurkis DOUBLE PRECISION DEFAULT NULL, ivercio_kiekis INT DEFAULT NULL, trukme TIME(0) WITHOUT TIME ZONE DEFAULT NULL, pelnas DOUBLE PRECISION DEFAULT NULL, islaidos DOUBLE PRECISION DEFAULT NULL, pajamos DOUBLE PRECISION DEFAULT NULL, originalus_pavadinimas TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE watch_list');
    }
}
