<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200227132503 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE specialty ADD study_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE specialty ADD CONSTRAINT FK_E066A6ECE7B003E9 FOREIGN KEY (study_id) REFERENCES study (id)');
        $this->addSql('CREATE INDEX IDX_E066A6ECE7B003E9 ON specialty (study_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE specialty DROP FOREIGN KEY FK_E066A6ECE7B003E9');
        $this->addSql('DROP INDEX IDX_E066A6ECE7B003E9 ON specialty');
        $this->addSql('ALTER TABLE specialty DROP study_id');
    }
}
