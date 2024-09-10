<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240902173622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post (
          id INT AUTO_INCREMENT NOT NULL,
          title VARCHAR(255) NOT NULL,
          body LONGTEXT DEFAULT NULL,
          published_at DATE DEFAULT NULL,
          slug VARCHAR(255) NOT NULL,
          authors LONGTEXT DEFAULT NULL,
          isbn VARCHAR(13) DEFAULT NULL,
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER
        SET
          utf8mb4');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE post');
    }
}
