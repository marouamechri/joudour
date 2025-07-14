<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250714122113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, fullname VARCHAR(250) NOT NULL, tel VARCHAR(250) NOT NULL, adresse VARCHAR(150) NOT NULL, message VARCHAR(255) DEFAULT NULL, country_code INT NOT NULL, city VARCHAR(100) NOT NULL, INDEX IDX_C35F0816A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, fullname VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, transport_name VARCHAR(255) NOT NULL, transport_price DOUBLE PRECISION NOT NULL, adresse_livraison LONGTEXT NOT NULL, more_information LONGTEXT DEFAULT NULL, is_paid TINYINT(1) NOT NULL, quantity_panier INT NOT NULL, sub_total_ht DOUBLE PRECISION NOT NULL, taxe DOUBLE PRECISION NOT NULL, sub_total_ttc DOUBLE PRECISION NOT NULL, creat_at DATETIME NOT NULL, reference VARCHAR(255) NOT NULL, INDEX IDX_BA388B7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_line (id INT AUTO_INCREMENT NOT NULL, cart_id INT NOT NULL, product_name VARCHAR(255) NOT NULL, product_price DOUBLE PRECISION NOT NULL, product_quantity INT NOT NULL, sub_total_product_ht DOUBLE PRECISION NOT NULL, taxe_product DOUBLE PRECISION NOT NULL, sub_toltal_product_ttc DOUBLE PRECISION NOT NULL, INDEX IDX_3EF1B4CF1AD5CDBF (cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name_category VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colors (id INT AUTO_INCREMENT NOT NULL, ref_color VARCHAR(20) NOT NULL, name_color VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cut (id INT AUTO_INCREMENT NOT NULL, cut_value VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_prices (id INT AUTO_INCREMENT NOT NULL, product_cut_id INT NOT NULL, start_date_prices_sale_htva DATETIME NOT NULL, amount_htva DOUBLE PRECISION NOT NULL, end_date_prices_sale_htva DATETIME NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_2D89CD0511B1D9A5 (product_cut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE imageweb_site (id INT AUTO_INCREMENT NOT NULL, poster VARCHAR(40) NOT NULL, titre_poster VARCHAR(50) NOT NULL, poster_text_btn VARCHAR(50) NOT NULL, robe1 VARCHAR(40) NOT NULL, robe2 VARCHAR(40) NOT NULL, robe3 VARCHAR(40) NOT NULL, img_shop1 VARCHAR(40) NOT NULL, img_shop2 VARCHAR(40) NOT NULL, img_shop3 VARCHAR(40) NOT NULL, imgloca1 VARCHAR(40) NOT NULL, imgloca2 VARCHAR(40) NOT NULL, imgloca3 VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name_option VARCHAR(20) NOT NULL, INDEX IDX_5A8600B012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, creat_at DATETIME NOT NULL, fullname VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, transport_name VARCHAR(255) NOT NULL, transport_price DOUBLE PRECISION NOT NULL, adresse_livraison LONGTEXT NOT NULL, more_information LONGTEXT DEFAULT NULL, is_paid TINYINT(1) NOT NULL, quantity_panier INT NOT NULL, sub_total_ht DOUBLE PRECISION NOT NULL, taxe DOUBLE PRECISION NOT NULL, sub_total_ttc DOUBLE PRECISION NOT NULL, reference VARCHAR(255) NOT NULL, stripe_checkout_session_id VARCHAR(255) DEFAULT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_line (id INT AUTO_INCREMENT NOT NULL, idorder_id INT NOT NULL, product_name VARCHAR(255) NOT NULL, product_price DOUBLE PRECISION NOT NULL, product_quantity INT NOT NULL, sub_total_product_ht DOUBLE PRECISION NOT NULL, taxe_product DOUBLE PRECISION NOT NULL, sub_toltal_product_ttc DOUBLE PRECISION NOT NULL, INDEX IDX_9CE58EE1274A2535 (idorder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, product_color_id INT DEFAULT NULL, picture_name VARCHAR(40) NOT NULL, INDEX IDX_16DB4F89B16A7522 (product_color_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, type_product_id INT NOT NULL, name_product VARCHAR(20) NOT NULL, description_product LONGTEXT NOT NULL, amount_htva DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL, action VARCHAR(255) NOT NULL, first_image VARCHAR(40) NOT NULL, active TINYINT(1) DEFAULT NULL, ref_product VARCHAR(10) NOT NULL, genre VARCHAR(15) NOT NULL, new_colletion TINYINT(1) DEFAULT NULL, INDEX IDX_D34A04AD5887B07F (type_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_color (id INT AUTO_INCREMENT NOT NULL, color_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_C70A33B57ADA1FB5 (color_id), INDEX IDX_C70A33B54584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_cut (id INT AUTO_INCREMENT NOT NULL, product_color_id INT NOT NULL, stock_id INT NOT NULL, cut_id INT NOT NULL, active TINYINT(1) DEFAULT NULL, INDEX IDX_50DFC0E2B16A7522 (product_color_id), UNIQUE INDEX UNIQ_50DFC0E2DCD6110 (stock_id), INDEX IDX_50DFC0E273CD9801 (cut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, stock_min INT NOT NULL, stock_max INT NOT NULL, nbr_product INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transporteur (id INT AUTO_INCREMENT NOT NULL, name_transport VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prices_transport DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, civilite VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, tel VARCHAR(15) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart_line ADD CONSTRAINT FK_3EF1B4CF1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE historique_prices ADD CONSTRAINT FK_2D89CD0511B1D9A5 FOREIGN KEY (product_cut_id) REFERENCES product_cut (id)');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE1274A2535 FOREIGN KEY (idorder_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89B16A7522 FOREIGN KEY (product_color_id) REFERENCES product_color (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5887B07F FOREIGN KEY (type_product_id) REFERENCES `option` (id)');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B57ADA1FB5 FOREIGN KEY (color_id) REFERENCES colors (id)');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B54584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_cut ADD CONSTRAINT FK_50DFC0E2B16A7522 FOREIGN KEY (product_color_id) REFERENCES product_color (id)');
        $this->addSql('ALTER TABLE product_cut ADD CONSTRAINT FK_50DFC0E2DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE product_cut ADD CONSTRAINT FK_50DFC0E273CD9801 FOREIGN KEY (cut_id) REFERENCES cut (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A76ED395');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE cart_line DROP FOREIGN KEY FK_3EF1B4CF1AD5CDBF');
        $this->addSql('ALTER TABLE historique_prices DROP FOREIGN KEY FK_2D89CD0511B1D9A5');
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B012469DE2');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE1274A2535');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89B16A7522');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5887B07F');
        $this->addSql('ALTER TABLE product_color DROP FOREIGN KEY FK_C70A33B57ADA1FB5');
        $this->addSql('ALTER TABLE product_color DROP FOREIGN KEY FK_C70A33B54584665A');
        $this->addSql('ALTER TABLE product_cut DROP FOREIGN KEY FK_50DFC0E2B16A7522');
        $this->addSql('ALTER TABLE product_cut DROP FOREIGN KEY FK_50DFC0E2DCD6110');
        $this->addSql('ALTER TABLE product_cut DROP FOREIGN KEY FK_50DFC0E273CD9801');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_line');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE colors');
        $this->addSql('DROP TABLE cut');
        $this->addSql('DROP TABLE historique_prices');
        $this->addSql('DROP TABLE imageweb_site');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_line');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_color');
        $this->addSql('DROP TABLE product_cut');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE transporteur');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
