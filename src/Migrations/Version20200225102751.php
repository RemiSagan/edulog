<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200225102751 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE choice (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, specialty_id_id INT NOT NULL, study_id_id INT NOT NULL, INDEX IDX_C1AB5A929D86650F (user_id_id), INDEX IDX_C1AB5A92DC32BB7B (specialty_id_id), INDEX IDX_C1AB5A92203ECEB7 (study_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A929D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92DC32BB7B FOREIGN KEY (specialty_id_id) REFERENCES specialty (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92203ECEB7 FOREIGN KEY (study_id_id) REFERENCES study (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE choice');
    }
}
