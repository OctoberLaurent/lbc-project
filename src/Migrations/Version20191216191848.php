<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191216191848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attachements (id INT AUTO_INCREMENT NOT NULL, media_id INT DEFAULT NULL, ad_id INT DEFAULT NULL, title VARCHAR(80) NOT NULL, INDEX IDX_212B82DCEA9FDD75 (media_id), INDEX IDX_212B82DC4F34D596 (ad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, slug VARCHAR(30) NOT NULL, color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE addresses (id INT AUTO_INCREMENT NOT NULL, adress VARCHAR(255) NOT NULL, additional VARCHAR(255) DEFAULT NULL, postalcode VARCHAR(10) NOT NULL, city VARCHAR(80) NOT NULL, region VARCHAR(80) DEFAULT NULL, country VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', type VARCHAR(255) NOT NULL, path VARCHAR(40) NOT NULL, INDEX IDX_6A2CA10CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offers (id INT AUTO_INCREMENT NOT NULL, user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ad_id INT DEFAULT NULL, price NUMERIC(10, 2) NOT NULL, message LONGTEXT NOT NULL, offer_date DATETIME NOT NULL, INDEX IDX_DA460427A76ED395 (user_id), INDEX IDX_DA4604274F34D596 (ad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachements ADD CONSTRAINT FK_212B82DCEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE attachements ADD CONSTRAINT FK_212B82DC4F34D596 FOREIGN KEY (ad_id) REFERENCES ads (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604274F34D596 FOREIGN KEY (ad_id) REFERENCES ads (id)');
        $this->addSql('ALTER TABLE users ADD picture_id INT DEFAULT NULL, ADD adress_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9EE45BDBF FOREIGN KEY (picture_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E98486F9AC FOREIGN KEY (adress_id) REFERENCES addresses (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9EE45BDBF ON users (picture_id)');
        $this->addSql('CREATE INDEX IDX_1483A5E98486F9AC ON users (adress_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E98486F9AC');
        $this->addSql('ALTER TABLE attachements DROP FOREIGN KEY FK_212B82DCEA9FDD75');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9EE45BDBF');
        $this->addSql('DROP TABLE attachements');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE addresses');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE offers');
        $this->addSql('DROP INDEX IDX_1483A5E9EE45BDBF ON users');
        $this->addSql('DROP INDEX IDX_1483A5E98486F9AC ON users');
        $this->addSql('ALTER TABLE users DROP picture_id, DROP adress_id');
    }
}
