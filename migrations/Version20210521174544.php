<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521174544 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction ADD moyen_id INT DEFAULT NULL, ADD is_deleted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D16C346E29 FOREIGN KEY (moyen_id) REFERENCES moyen (id)');
        $this->addSql('CREATE INDEX IDX_723705D16C346E29 ON transaction (moyen_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D16C346E29');
        $this->addSql('DROP INDEX IDX_723705D16C346E29 ON transaction');
        $this->addSql('ALTER TABLE transaction DROP moyen_id, DROP is_deleted');
    }
}
