<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519155047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cut (id INT AUTO_INCREMENT NOT NULL, cut_value VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_prices (id INT AUTO_INCREMENT NOT NULL, start_prices_sale_htva DATE NOT NULL, end_date_prices_sale DATE NOT NULL, amount_htva DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_cut (id INT AUTO_INCREMENT NOT NULL, stock_id INT DEFAULT NULL, historique_prices_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_50DFC0E2DCD6110 (stock_id), UNIQUE INDEX UNIQ_50DFC0E28ABA9571 (historique_prices_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_cut ADD CONSTRAINT FK_50DFC0E2DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE product_cut ADD CONSTRAINT FK_50DFC0E28ABA9571 FOREIGN KEY (historique_prices_id) REFERENCES historique_prices (id)');
        $this->addSql('ALTER TABLE product_color ADD cut_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B573CD9801 FOREIGN KEY (cut_id) REFERENCES cut (id)');
        $this->addSql('CREATE INDEX IDX_C70A33B573CD9801 ON product_color (cut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_color DROP FOREIGN KEY FK_C70A33B573CD9801');
        $this->addSql('ALTER TABLE product_cut DROP FOREIGN KEY FK_50DFC0E28ABA9571');
        $this->addSql('DROP TABLE cut');
        $this->addSql('DROP TABLE historique_prices');
        $this->addSql('DROP TABLE product_cut');
        $this->addSql('DROP INDEX IDX_C70A33B573CD9801 ON product_color');
        $this->addSql('ALTER TABLE product_color DROP cut_id');
    }
}
