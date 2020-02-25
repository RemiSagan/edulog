<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200225103029 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92203ECEB7');
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A929D86650F');
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92DC32BB7B');
        $this->addSql('DROP INDEX IDX_C1AB5A92DC32BB7B ON choice');
        $this->addSql('DROP INDEX IDX_C1AB5A92203ECEB7 ON choice');
        $this->addSql('DROP INDEX IDX_C1AB5A929D86650F ON choice');
        $this->addSql('ALTER TABLE choice ADD user_id INT NOT NULL, ADD specialty_id INT NOT NULL, ADD study_id INT NOT NULL, DROP user_id_id, DROP specialty_id_id, DROP study_id_id');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A929A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92E7B003E9 FOREIGN KEY (study_id) REFERENCES study (id)');
        $this->addSql('CREATE INDEX IDX_C1AB5A92A76ED395 ON choice (user_id)');
        $this->addSql('CREATE INDEX IDX_C1AB5A929A353316 ON choice (specialty_id)');
        $this->addSql('CREATE INDEX IDX_C1AB5A92E7B003E9 ON choice (study_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92A76ED395');
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A929A353316');
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92E7B003E9');
        $this->addSql('DROP INDEX IDX_C1AB5A92A76ED395 ON choice');
        $this->addSql('DROP INDEX IDX_C1AB5A929A353316 ON choice');
        $this->addSql('DROP INDEX IDX_C1AB5A92E7B003E9 ON choice');
        $this->addSql('ALTER TABLE choice ADD user_id_id INT NOT NULL, ADD specialty_id_id INT NOT NULL, ADD study_id_id INT NOT NULL, DROP user_id, DROP specialty_id, DROP study_id');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92203ECEB7 FOREIGN KEY (study_id_id) REFERENCES study (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A929D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92DC32BB7B FOREIGN KEY (specialty_id_id) REFERENCES specialty (id)');
        $this->addSql('CREATE INDEX IDX_C1AB5A92DC32BB7B ON choice (specialty_id_id)');
        $this->addSql('CREATE INDEX IDX_C1AB5A92203ECEB7 ON choice (study_id_id)');
        $this->addSql('CREATE INDEX IDX_C1AB5A929D86650F ON choice (user_id_id)');
    }
}
