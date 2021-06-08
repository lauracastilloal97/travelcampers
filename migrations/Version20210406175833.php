<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406175833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ofertas (id INT AUTO_INCREMENT NOT NULL, vehiculo_id INT DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, precio VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_48C925F325F7D575 (vehiculo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ofertas ADD CONSTRAINT FK_48C925F325F7D575 FOREIGN KEY (vehiculo_id) REFERENCES campers (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ofertas');
    }
}
