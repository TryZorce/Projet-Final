<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231203000025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, stock INT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_categorie (article_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_934886107294869C (article_id), INDEX IDX_93488610BCF5E72D (categorie_id), PRIMARY KEY(article_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_cart (article_id INT NOT NULL, cart_id INT NOT NULL, INDEX IDX_BBE10FB67294869C (article_id), INDEX IDX_BBE10FB61AD5CDBF (cart_id), PRIMARY KEY(article_id, cart_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, promotion_id_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_BA388B7A76ED395 (user_id), UNIQUE INDEX UNIQ_BA388B71F42EA0A (promotion_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categoryname VARCHAR(30) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, cart_id_id INT DEFAULT NULL, invoicedate DATE NOT NULL, totalamount DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_9065174420AEF35F (cart_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, messagecontent LONGTEXT NOT NULL, datetimesent DATETIME NOT NULL, attachment VARCHAR(50) DEFAULT NULL, title VARCHAR(45) NOT NULL, INDEX IDX_B6BD307F9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, promotionname VARCHAR(50) NOT NULL, code VARCHAR(45) NOT NULL, reduction DOUBLE PRECISION NOT NULL, percentage SMALLINT NOT NULL, enddate DATE DEFAULT NULL, startdate DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, gdpr DATE DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_934886107294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_93488610BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_cart ADD CONSTRAINT FK_BBE10FB67294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_cart ADD CONSTRAINT FK_BBE10FB61AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B71F42EA0A FOREIGN KEY (promotion_id_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174420AEF35F FOREIGN KEY (cart_id_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_934886107294869C');
        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_93488610BCF5E72D');
        $this->addSql('ALTER TABLE article_cart DROP FOREIGN KEY FK_BBE10FB67294869C');
        $this->addSql('ALTER TABLE article_cart DROP FOREIGN KEY FK_BBE10FB61AD5CDBF');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B71F42EA0A');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174420AEF35F');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F9D86650F');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_categorie');
        $this->addSql('DROP TABLE article_cart');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
