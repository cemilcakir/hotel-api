<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416172438 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6A8F93B6FC');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(70) NOT NULL, link VARCHAR(255) NOT NULL, star INT NOT NULL, phone VARCHAR(11) NOT NULL, mail VARCHAR(255) NOT NULL, county VARCHAR(70) NOT NULL, province VARCHAR(70) NOT NULL, state VARCHAR(70) NOT NULL, address VARCHAR(255) NOT NULL, detail LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(70) NOT NULL, price INT NOT NULL, floor INT NOT NULL, detail LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE role');
        $this->addSql('ALTER TABLE person ADD kullaniciTC VARCHAR(255) NOT NULL, ADD mail VARCHAR(255) NOT NULL, DROP biography');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD176E18B3577 ON person (kullaniciTC)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, year SMALLINT NOT NULL, time SMALLINT NOT NULL, description LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, movie_id INT DEFAULT NULL, played_name VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_57698A6A217BBB47 (person_id), INDEX IDX_57698A6A8F93B6FC (movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP INDEX UNIQ_34DCD176E18B3577 ON person');
        $this->addSql('ALTER TABLE person ADD biography LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, DROP kullaniciTC, DROP mail');
    }
}
