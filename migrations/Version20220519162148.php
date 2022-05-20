<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519162148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC54C8C93 FOREIGN KEY (type_id) REFERENCES `option` (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADC54C8C93 ON product (type_id)');
        $this->addSql('ALTER TABLE product_cut DROP FOREIGN KEY FK_50DFC0E2C54C8C93');
        $this->addSql('DROP INDEX IDX_50DFC0E2C54C8C93 ON product_cut');
        $this->addSql('ALTER TABLE product_cut DROP type_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC54C8C93');
        $this->addSql('DROP INDEX IDX_D34A04ADC54C8C93 ON product');
        $this->addSql('ALTER TABLE product DROP type_id');
        $this->addSql('ALTER TABLE product_cut ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_cut ADD CONSTRAINT FK_50DFC0E2C54C8C93 FOREIGN KEY (type_id) REFERENCES `option` (id)');
        $this->addSql('CREATE INDEX IDX_50DFC0E2C54C8C93 ON product_cut (type_id)');
    }
}
