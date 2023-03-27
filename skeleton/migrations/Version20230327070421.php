<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327070421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comm_post (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, date DATETIME NOT NULL, category VARCHAR(255) NOT NULL, content VARCHAR(501) DEFAULT NULL, INDEX IDX_15AAC1F29D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comm_post ADD CONSTRAINT FK_15AAC1F29D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ski_lift CHANGE information information VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ski_track ADD ski_lift_id INT DEFAULT NULL, CHANGE information information LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE ski_track ADD CONSTRAINT FK_5191EBFC51447D0B FOREIGN KEY (ski_lift_id) REFERENCES ski_lift (id)');
        $this->addSql('CREATE INDEX IDX_5191EBFC51447D0B ON ski_track (ski_lift_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comm_post DROP FOREIGN KEY FK_15AAC1F29D86650F');
        $this->addSql('DROP TABLE comm_post');
        $this->addSql('ALTER TABLE ski_lift CHANGE information information VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ski_track DROP FOREIGN KEY FK_5191EBFC51447D0B');
        $this->addSql('DROP INDEX IDX_5191EBFC51447D0B ON ski_track');
        $this->addSql('ALTER TABLE ski_track DROP ski_lift_id, CHANGE information information LONGTEXT NOT NULL');
    }
}
