<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519160128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_color DROP FOREIGN KEY FK_C70A33B5DCD6110');
        $this->addSql('DROP INDEX UNIQ_C70A33B5DCD6110 ON product_color');
        $this->addSql('ALTER TABLE product_color DROP stock_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_color ADD stock_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B5DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C70A33B5DCD6110 ON product_color (stock_id)');
    }
}
