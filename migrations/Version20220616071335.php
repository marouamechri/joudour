<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616071335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD fullname VARCHAR(100) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD transport_name VARCHAR(255) NOT NULL, ADD transport_price DOUBLE PRECISION NOT NULL, ADD adresse_livraison LONGTEXT NOT NULL, ADD more_information LONGTEXT DEFAULT NULL, ADD is_paid TINYINT(1) NOT NULL, ADD quantity_panier INT NOT NULL, ADD sub_total_ht DOUBLE PRECISION NOT NULL, ADD taxe DOUBLE PRECISION NOT NULL, ADD sub_total_ttc DOUBLE PRECISION NOT NULL, ADD reference VARCHAR(255) NOT NULL, DROP status');
        $this->addSql('ALTER TABLE order_line ADD product_name VARCHAR(255) NOT NULL, ADD product_price DOUBLE PRECISION NOT NULL, ADD product_quantity INT NOT NULL, ADD sub_total_product_ht DOUBLE PRECISION NOT NULL, ADD taxe_product DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD status TINYINT(1) DEFAULT NULL, DROP fullname, DROP email, DROP transport_name, DROP transport_price, DROP adresse_livraison, DROP more_information, DROP is_paid, DROP quantity_panier, DROP sub_total_ht, DROP taxe, DROP sub_total_ttc, DROP reference');
        $this->addSql('ALTER TABLE order_line DROP product_name, DROP product_price, DROP product_quantity, DROP sub_total_product_ht, DROP taxe_product');
    }
}
