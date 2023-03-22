<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322132534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ski_lift ADD station_id INT NOT NULL');
        $this->addSql('ALTER TABLE ski_lift ADD CONSTRAINT FK_9CD969D21BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('CREATE INDEX IDX_9CD969D21BDB235 ON ski_lift (station_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ski_lift DROP FOREIGN KEY FK_9CD969D21BDB235');
        $this->addSql('DROP INDEX IDX_9CD969D21BDB235 ON ski_lift');
        $this->addSql('ALTER TABLE ski_lift DROP station_id');
    }
}
