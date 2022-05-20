<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220520115721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique_prices ADD product_cut_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historique_prices ADD CONSTRAINT FK_2D89CD0511B1D9A5 FOREIGN KEY (product_cut_id) REFERENCES product_cut (id)');
        $this->addSql('CREATE INDEX IDX_2D89CD0511B1D9A5 ON historique_prices (product_cut_id)');
        $this->addSql('ALTER TABLE product_color ADD ref_product VARCHAR(10) NOT NULL, ADD name_product VARCHAR(50) NOT NULL, ADD description_product LONGTEXT NOT NULL, ADD prices_htva DOUBLE PRECISION NOT NULL, ADD lease TINYINT(1) NOT NULL, ADD sale TINYINT(1) NOT NULL, ADD created_at DATETIME NOT NULL, ADD update_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE product_cut DROP FOREIGN KEY FK_50DFC0E28ABA9571');
        $this->addSql('DROP INDEX UNIQ_50DFC0E28ABA9571 ON product_cut');
        $this->addSql('ALTER TABLE product_cut ADD ref_product VARCHAR(10) NOT NULL, ADD name_product VARCHAR(50) NOT NULL, ADD description_product LONGTEXT NOT NULL, ADD prices_htva DOUBLE PRECISION NOT NULL, ADD lease TINYINT(1) NOT NULL, ADD sale TINYINT(1) NOT NULL, ADD created_at DATETIME NOT NULL, ADD update_at DATETIME DEFAULT NULL, DROP historique_prices_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique_prices DROP FOREIGN KEY FK_2D89CD0511B1D9A5');
        $this->addSql('DROP INDEX IDX_2D89CD0511B1D9A5 ON historique_prices');
        $this->addSql('ALTER TABLE historique_prices DROP product_cut_id');
        $this->addSql('ALTER TABLE product_color DROP ref_product, DROP name_product, DROP description_product, DROP prices_htva, DROP lease, DROP sale, DROP created_at, DROP update_at');
        $this->addSql('ALTER TABLE product_cut ADD historique_prices_id INT DEFAULT NULL, DROP ref_product, DROP name_product, DROP description_product, DROP prices_htva, DROP lease, DROP sale, DROP created_at, DROP update_at');
        $this->addSql('ALTER TABLE product_cut ADD CONSTRAINT FK_50DFC0E28ABA9571 FOREIGN KEY (historique_prices_id) REFERENCES historique_prices (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_50DFC0E28ABA9571 ON product_cut (historique_prices_id)');
    }
}
