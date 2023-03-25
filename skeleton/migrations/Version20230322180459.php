<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322180459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE domain (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ski_lift ADD station_id INT NOT NULL');
        $this->addSql('ALTER TABLE ski_lift ADD CONSTRAINT FK_9CD969D21BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('CREATE INDEX IDX_9CD969D21BDB235 ON ski_lift (station_id)');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B14272FC9F');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B14272FC9F FOREIGN KEY (domaine_id) REFERENCES domain (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B14272FC9F');
        $this->addSql('DROP TABLE domain');
        $this->addSql('ALTER TABLE ski_lift DROP FOREIGN KEY FK_9CD969D21BDB235');
        $this->addSql('DROP INDEX IDX_9CD969D21BDB235 ON ski_lift');
        $this->addSql('ALTER TABLE ski_lift DROP station_id');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B14272FC9F');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B14272FC9F FOREIGN KEY (domaine_id) REFERENCES user (id)');
    }
}
