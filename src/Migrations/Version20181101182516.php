<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181101182516 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE offert_skills (offert_id INT NOT NULL, skills_id INT NOT NULL, INDEX IDX_291649FA3D478C97 (offert_id), INDEX IDX_291649FA7FF61858 (skills_id), PRIMARY KEY(offert_id, skills_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offert_skills ADD CONSTRAINT FK_291649FA3D478C97 FOREIGN KEY (offert_id) REFERENCES offert (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offert_skills ADD CONSTRAINT FK_291649FA7FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offert DROP FOREIGN KEY FK_442291847FF61858');
        $this->addSql('DROP INDEX IDX_442291847FF61858 ON offert');
        $this->addSql('ALTER TABLE offert DROP skills_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE offert_skills');
        $this->addSql('ALTER TABLE offert ADD skills_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offert ADD CONSTRAINT FK_442291847FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id)');
        $this->addSql('CREATE INDEX IDX_442291847FF61858 ON offert (skills_id)');
    }
}
