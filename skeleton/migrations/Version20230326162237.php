<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230326162237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ski_track ADD ski_lift_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ski_track ADD CONSTRAINT FK_5191EBFC51447D0B FOREIGN KEY (ski_lift_id) REFERENCES ski_lift (id)');
        $this->addSql('CREATE INDEX IDX_5191EBFC51447D0B ON ski_track (ski_lift_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ski_track DROP FOREIGN KEY FK_5191EBFC51447D0B');
        $this->addSql('DROP INDEX IDX_5191EBFC51447D0B ON ski_track');
        $this->addSql('ALTER TABLE ski_track DROP ski_lift_id');
    }
}
