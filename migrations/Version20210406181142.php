<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406181142 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ofertas ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ofertas ADD CONSTRAINT FK_48C925F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_48C925F3A76ED395 ON ofertas (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ofertas DROP FOREIGN KEY FK_48C925F3A76ED395');
        $this->addSql('DROP INDEX IDX_48C925F3A76ED395 ON ofertas');
        $this->addSql('ALTER TABLE ofertas DROP user_id');
    }
}
