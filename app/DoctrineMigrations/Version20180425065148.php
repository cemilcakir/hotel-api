<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180425065148 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_34DCD176E18B3577 ON person');
        $this->addSql('ALTER TABLE person CHANGE userId userId INT NOT NULL');
        $this->addSql('ALTER TABLE hotel CHANGE link link VARCHAR(255) NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL, CHANGE county county VARCHAR(70) NOT NULL, CHANGE province province VARCHAR(70) NOT NULL, CHANGE state state VARCHAR(70) NOT NULL, CHANGE address address VARCHAR(255) NOT NULL, CHANGE detail detail LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE room CHANGE hotelId hotelId INT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hotel CHANGE link link VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, CHANGE mail mail VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, CHANGE county county VARCHAR(70) DEFAULT NULL COLLATE utf8_general_ci, CHANGE province province VARCHAR(70) DEFAULT NULL COLLATE utf8_general_ci, CHANGE state state VARCHAR(70) DEFAULT NULL COLLATE utf8_general_ci, CHANGE address address VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, CHANGE detail detail LONGTEXT DEFAULT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE person CHANGE userId userId INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD176E18B3577 ON person (kullaniciTC)');
        $this->addSql('ALTER TABLE room CHANGE hotelId hotelId INT DEFAULT NULL');
    }
}
