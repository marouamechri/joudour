<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607215646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bill (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bill_line (id INT AUTO_INCREMENT NOT NULL, delivery_line_id INT NOT NULL, bill_id INT NOT NULL, UNIQUE INDEX UNIQ_220BDC5C4765CA9C (delivery_line_id), INDEX IDX_220BDC5C1A8C12F5 (bill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delevery_line (id INT AUTO_INCREMENT NOT NULL, delevery_id INT NOT NULL, order_line_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_1AB49CE245BC7C6E (delevery_id), UNIQUE INDEX UNIQ_1AB49CE2BB01DC09 (order_line_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, adress_id INT NOT NULL, delevry_date DATETIME NOT NULL, status VARCHAR(20) NOT NULL, INDEX IDX_3781EC108486F9AC (adress_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, creat_at DATETIME NOT NULL, status TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_line (id INT AUTO_INCREMENT NOT NULL, idorder_id INT NOT NULL, product_cut_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_9CE58EE1274A2535 (idorder_id), INDEX IDX_9CE58EE111B1D9A5 (product_cut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bill_line ADD CONSTRAINT FK_220BDC5C4765CA9C FOREIGN KEY (delivery_line_id) REFERENCES delevery_line (id)');
        $this->addSql('ALTER TABLE bill_line ADD CONSTRAINT FK_220BDC5C1A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id)');
        $this->addSql('ALTER TABLE delevery_line ADD CONSTRAINT FK_1AB49CE245BC7C6E FOREIGN KEY (delevery_id) REFERENCES delivery (id)');
        $this->addSql('ALTER TABLE delevery_line ADD CONSTRAINT FK_1AB49CE2BB01DC09 FOREIGN KEY (order_line_id) REFERENCES order_line (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC108486F9AC FOREIGN KEY (adress_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE1274A2535 FOREIGN KEY (idorder_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE111B1D9A5 FOREIGN KEY (product_cut_id) REFERENCES product_cut (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill_line DROP FOREIGN KEY FK_220BDC5C1A8C12F5');
        $this->addSql('ALTER TABLE bill_line DROP FOREIGN KEY FK_220BDC5C4765CA9C');
        $this->addSql('ALTER TABLE delevery_line DROP FOREIGN KEY FK_1AB49CE245BC7C6E');
        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE1274A2535');
        $this->addSql('ALTER TABLE delevery_line DROP FOREIGN KEY FK_1AB49CE2BB01DC09');
        $this->addSql('DROP TABLE bill');
        $this->addSql('DROP TABLE bill_line');
        $this->addSql('DROP TABLE delevery_line');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_line');
    }
}
