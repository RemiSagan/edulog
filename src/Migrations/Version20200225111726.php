<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200225111726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92E7B003E9');
        $this->addSql('CREATE TABLE user_specialty (user_id INT NOT NULL, specialty_id INT NOT NULL, INDEX IDX_E0862B08A76ED395 (user_id), INDEX IDX_E0862B089A353316 (specialty_id), PRIMARY KEY(user_id, specialty_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_specialty ADD CONSTRAINT FK_E0862B08A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_specialty ADD CONSTRAINT FK_E0862B089A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE choice');
        $this->addSql('DROP TABLE study');
        $this->addSql('ALTER TABLE specialty ADD duration SMALLINT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE choice (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, specialty_id INT NOT NULL, study_id INT NOT NULL, INDEX IDX_C1AB5A929A353316 (specialty_id), INDEX IDX_C1AB5A92E7B003E9 (study_id), INDEX IDX_C1AB5A92A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE study (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, duration SMALLINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A929A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92E7B003E9 FOREIGN KEY (study_id) REFERENCES study (id)');
        $this->addSql('DROP TABLE user_specialty');
        $this->addSql('ALTER TABLE specialty DROP duration');
    }
}
