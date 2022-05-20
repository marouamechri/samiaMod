<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519155946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_cut ADD cut_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_cut ADD CONSTRAINT FK_50DFC0E273CD9801 FOREIGN KEY (cut_id) REFERENCES cut (id)');
        $this->addSql('CREATE INDEX IDX_50DFC0E273CD9801 ON product_cut (cut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_cut DROP FOREIGN KEY FK_50DFC0E273CD9801');
        $this->addSql('DROP INDEX IDX_50DFC0E273CD9801 ON product_cut');
        $this->addSql('ALTER TABLE product_cut DROP cut_id');
    }
}
