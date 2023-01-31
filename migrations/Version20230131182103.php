<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131182103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adress (id INT AUTO_INCREMENT NOT NULL, first_line VARCHAR(255) NOT NULL, second_line VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(5) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, adress_customer_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, mobile_phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_81398E0961DD9D99 (adress_customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE farrier (id INT AUTO_INCREMENT NOT NULL, adress_farrier_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, role VARCHAR(255) DEFAULT NULL, INDEX IDX_1501DEBBEDA82880 (adress_farrier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horse (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, hoster_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, nickname VARCHAR(255) DEFAULT NULL, birth_date DATE DEFAULT NULL, type VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, sire VARCHAR(255) DEFAULT NULL, transponder VARCHAR(255) NOT NULL, duration INT DEFAULT NULL, INDEX IDX_629A2F187E3C61F9 (owner_id), INDEX IDX_629A2F184CAE8C6C (hoster_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hoster (id INT AUTO_INCREMENT NOT NULL, adress_hoster_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C2F48C047DA14B97 (adress_hoster_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, horse_id INT DEFAULT NULL, start_date DATETIME DEFAULT NULL, end_date DATETIME DEFAULT NULL, service VARCHAR(255) NOT NULL, horse_shoe_size VARCHAR(255) DEFAULT NULL, done TINYINT(1) NOT NULL, pathologies VARCHAR(255) DEFAULT NULL, comments VARCHAR(255) DEFAULT NULL, INDEX IDX_D11814AB76B275AD (horse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E0961DD9D99 FOREIGN KEY (adress_customer_id) REFERENCES adress (id)');
        $this->addSql('ALTER TABLE farrier ADD CONSTRAINT FK_1501DEBBEDA82880 FOREIGN KEY (adress_farrier_id) REFERENCES adress (id)');
        $this->addSql('ALTER TABLE horse ADD CONSTRAINT FK_629A2F187E3C61F9 FOREIGN KEY (owner_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE horse ADD CONSTRAINT FK_629A2F184CAE8C6C FOREIGN KEY (hoster_id) REFERENCES hoster (id)');
        $this->addSql('ALTER TABLE hoster ADD CONSTRAINT FK_C2F48C047DA14B97 FOREIGN KEY (adress_hoster_id) REFERENCES adress (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB76B275AD FOREIGN KEY (horse_id) REFERENCES horse (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E0961DD9D99');
        $this->addSql('ALTER TABLE farrier DROP FOREIGN KEY FK_1501DEBBEDA82880');
        $this->addSql('ALTER TABLE horse DROP FOREIGN KEY FK_629A2F187E3C61F9');
        $this->addSql('ALTER TABLE horse DROP FOREIGN KEY FK_629A2F184CAE8C6C');
        $this->addSql('ALTER TABLE hoster DROP FOREIGN KEY FK_C2F48C047DA14B97');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB76B275AD');
        $this->addSql('DROP TABLE adress');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE farrier');
        $this->addSql('DROP TABLE horse');
        $this->addSql('DROP TABLE hoster');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
