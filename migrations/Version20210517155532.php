<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210517155532 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ofertas');
        $this->addSql('ALTER TABLE campers ADD dimensiones VARCHAR(255) DEFAULT NULL, ADD capacidad VARCHAR(255) DEFAULT NULL, ADD wc VARCHAR(255) DEFAULT NULL, ADD camas VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ofertas (id INT AUTO_INCREMENT NOT NULL, vehiculo_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nombre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, precio VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, descripcion VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_48C925F325F7D575 (vehiculo_id), INDEX IDX_48C925F3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ofertas ADD CONSTRAINT FK_48C925F325F7D575 FOREIGN KEY (vehiculo_id) REFERENCES campers (id)');
        $this->addSql('ALTER TABLE ofertas ADD CONSTRAINT FK_48C925F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE campers DROP dimensiones, DROP capacidad, DROP wc, DROP camas');
    }
}
