<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524183701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique_prices DROP FOREIGN KEY FK_2D89CD0511B1D9A5');
        $this->addSql('DROP INDEX IDX_2D89CD0511B1D9A5 ON historique_prices');
        $this->addSql('ALTER TABLE historique_prices DROP product_cut_id, DROP end_date_prices_sale_htva');
        $this->addSql('ALTER TABLE product ADD first_image VARCHAR(15) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique_prices ADD product_cut_id INT NOT NULL, ADD end_date_prices_sale_htva DATETIME NOT NULL');
        $this->addSql('ALTER TABLE historique_prices ADD CONSTRAINT FK_2D89CD0511B1D9A5 FOREIGN KEY (product_cut_id) REFERENCES product_cut (id)');
        $this->addSql('CREATE INDEX IDX_2D89CD0511B1D9A5 ON historique_prices (product_cut_id)');
        $this->addSql('ALTER TABLE product DROP first_image');
    }
}
