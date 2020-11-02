<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201101183604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE address_books (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_id INTEGER DEFAULT NULL, country_id INTEGER DEFAULT NULL, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, street_number VARCHAR(30) NOT NULL, zip INTEGER NOT NULL, phonenumber VARCHAR(15) NOT NULL, birthday DATE NOT NULL, email VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_7DBE5DB28BAC62AF ON address_books (city_id)');
        $this->addSql('CREATE INDEX IDX_7DBE5DB2F92F3E70 ON address_books (country_id)');
        $this->addSql('CREATE TABLE city (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE country (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_name VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE address_books');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE country');
    }
}
