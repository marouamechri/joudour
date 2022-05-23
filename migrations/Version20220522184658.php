<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220522184658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name_category VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, ref_color VARCHAR(7) NOT NULL, name_color VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cut (id INT AUTO_INCREMENT NOT NULL, cut_value VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_prices (id INT AUTO_INCREMENT NOT NULL, product_cut_id INT NOT NULL, start_date_prices_sale_htva DATETIME NOT NULL, end_date_prices_sale_htva DATETIME NOT NULL, amount_htva DOUBLE PRECISION NOT NULL, INDEX IDX_2D89CD0511B1D9A5 (product_cut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name_option VARCHAR(20) NOT NULL, INDEX IDX_5A8600B012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, product_color_id INT NOT NULL, picture_name VARCHAR(15) NOT NULL, INDEX IDX_16DB4F89B16A7522 (product_color_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, type_product_id INT NOT NULL, name_product VARCHAR(20) NOT NULL, description_product LONGTEXT NOT NULL, amount_htva DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, lease TINYINT(1) NOT NULL, sale TINYINT(1) NOT NULL, INDEX IDX_D34A04AD5887B07F (type_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_color (id INT AUTO_INCREMENT NOT NULL, color_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_C70A33B57ADA1FB5 (color_id), INDEX IDX_C70A33B54584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_cut (id INT AUTO_INCREMENT NOT NULL, product_color_id INT NOT NULL, stock_id INT NOT NULL, cut_id INT NOT NULL, INDEX IDX_50DFC0E2B16A7522 (product_color_id), UNIQUE INDEX UNIQ_50DFC0E2DCD6110 (stock_id), INDEX IDX_50DFC0E273CD9801 (cut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, stock_min INT NOT NULL, stock_max INT NOT NULL, nbr_product INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historique_prices ADD CONSTRAINT FK_2D89CD0511B1D9A5 FOREIGN KEY (product_cut_id) REFERENCES product_cut (id)');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89B16A7522 FOREIGN KEY (product_color_id) REFERENCES product_color (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5887B07F FOREIGN KEY (type_product_id) REFERENCES `option` (id)');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B57ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B54584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_cut ADD CONSTRAINT FK_50DFC0E2B16A7522 FOREIGN KEY (product_color_id) REFERENCES product_color (id)');
        $this->addSql('ALTER TABLE product_cut ADD CONSTRAINT FK_50DFC0E2DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE product_cut ADD CONSTRAINT FK_50DFC0E273CD9801 FOREIGN KEY (cut_id) REFERENCES cut (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B012469DE2');
        $this->addSql('ALTER TABLE product_color DROP FOREIGN KEY FK_C70A33B57ADA1FB5');
        $this->addSql('ALTER TABLE product_cut DROP FOREIGN KEY FK_50DFC0E273CD9801');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5887B07F');
        $this->addSql('ALTER TABLE product_color DROP FOREIGN KEY FK_C70A33B54584665A');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89B16A7522');
        $this->addSql('ALTER TABLE product_cut DROP FOREIGN KEY FK_50DFC0E2B16A7522');
        $this->addSql('ALTER TABLE historique_prices DROP FOREIGN KEY FK_2D89CD0511B1D9A5');
        $this->addSql('ALTER TABLE product_cut DROP FOREIGN KEY FK_50DFC0E2DCD6110');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE cut');
        $this->addSql('DROP TABLE historique_prices');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_color');
        $this->addSql('DROP TABLE product_cut');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
