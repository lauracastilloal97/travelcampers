<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420172249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campers (id INT AUTO_INCREMENT NOT NULL, matricula VARCHAR(255) NOT NULL, marca VARCHAR(255) NOT NULL, modelo VARCHAR(255) NOT NULL, precio INT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ofertas (id INT AUTO_INCREMENT NOT NULL, vehiculo_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, precio VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_48C925F325F7D575 (vehiculo_id), INDEX IDX_48C925F3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, campers_id INT DEFAULT NULL, user_id INT DEFAULT NULL, fecha DATE NOT NULL, UNIQUE INDEX UNIQ_188D2E3BE6519B5 (campers_id), INDEX IDX_188D2E3BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_data (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, fistname VARCHAR(255) NOT NULL, lastname VARCHAR(255) DEFAULT NULL, dni VARCHAR(10) NOT NULL, birthdate DATE NOT NULL, genre VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, cp INT NOT NULL, phone_number VARCHAR(255) NOT NULL, factura INT NOT NULL, UNIQUE INDEX UNIQ_D772BFAAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ofertas ADD CONSTRAINT FK_48C925F325F7D575 FOREIGN KEY (vehiculo_id) REFERENCES campers (id)');
        $this->addSql('ALTER TABLE ofertas ADD CONSTRAINT FK_48C925F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BE6519B5 FOREIGN KEY (campers_id) REFERENCES campers (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_data ADD CONSTRAINT FK_D772BFAAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ofertas DROP FOREIGN KEY FK_48C925F325F7D575');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BE6519B5');
        $this->addSql('ALTER TABLE ofertas DROP FOREIGN KEY FK_48C925F3A76ED395');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BA76ED395');
        $this->addSql('ALTER TABLE user_data DROP FOREIGN KEY FK_D772BFAAA76ED395');
        $this->addSql('DROP TABLE campers');
        $this->addSql('DROP TABLE ofertas');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_data');
    }
}
