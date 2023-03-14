<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313134110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce ADD categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5A21214B7 FOREIGN KEY (categories_id) REFERENCES rcategorie (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5A21214B7 ON annonce (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5A21214B7');
        $this->addSql('DROP INDEX IDX_F65593E5A21214B7 ON annonce');
        $this->addSql('ALTER TABLE annonce DROP categories_id');
    }
}
