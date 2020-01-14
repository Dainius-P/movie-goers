<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114085104 extends AbstractMigration
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
        $this->addSql('DROP TABLE movie');
        $this->addSql('ALTER TABLE "user" ADD username VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD watch_list_size INT NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP name');
        $this->addSql('ALTER TABLE "user" DROP pass');
        $this->addSql('ALTER TABLE "user" DROP watc_list_size');
        $this->addSql('ALTER TABLE "user" DROP role');
        $this->addSql('ALTER TABLE "user" ALTER image SET NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE movie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE movie (id INT NOT NULL, pavadinimas VARCHAR(255) NOT NULL, isleidimo_data DATE DEFAULT NULL, ivercio_vidurkis DOUBLE PRECISION DEFAULT NULL, ivercio_kiekis INT DEFAULT NULL, trukme TIME(0) WITHOUT TIME ZONE DEFAULT NULL, pelnas DOUBLE PRECISION DEFAULT NULL, islaidos DOUBLE PRECISION DEFAULT NULL, pajamos DOUBLE PRECISION DEFAULT NULL, originalus_pavadinimas TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('ALTER TABLE "user" ADD name VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD pass VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD role INT NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP username');
        $this->addSql('ALTER TABLE "user" DROP roles');
        $this->addSql('ALTER TABLE "user" DROP password');
        $this->addSql('ALTER TABLE "user" ALTER image DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN watch_list_size TO watc_list_size');
    }
}
