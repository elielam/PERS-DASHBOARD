<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180419134610 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE APP_ACCOUNTS (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, libelle VARCHAR(40) NOT NULL, salary_day DATETIME NOT NULL, balance DOUBLE PRECISION NOT NULL, at_first_balance DOUBLE PRECISION NOT NULL, interest_draft DOUBLE PRECISION NOT NULL, overdraft DOUBLE PRECISION NOT NULL, INDEX IDX_D58B35B2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE APP_OPERATION_CATEGORIES (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE APP_OPERATIONS_MINUS (id INT AUTO_INCREMENT NOT NULL, account_id INT DEFAULT NULL, operation_category_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, datetime DATETIME NOT NULL, sum DOUBLE PRECISION NOT NULL, is_debit TINYINT(1) NOT NULL, INDEX IDX_4178F4079B6B5FBA (account_id), INDEX IDX_4178F407EA6AA4E4 (operation_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE APP_OPERATIONS_PLUS (id INT AUTO_INCREMENT NOT NULL, account_id INT DEFAULT NULL, operation_category_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, datetime DATETIME NOT NULL, sum DOUBLE PRECISION NOT NULL, is_credit TINYINT(1) NOT NULL, INDEX IDX_970934D89B6B5FBA (account_id), INDEX IDX_970934D8EA6AA4E4 (operation_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, lastname VARCHAR(20) NOT NULL, birthdate DATETIME NOT NULL, email VARCHAR(40) NOT NULL, password VARCHAR(100) NOT NULL, salt INT DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(40) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE APP_ACCOUNTS ADD CONSTRAINT FK_D58B35B2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE APP_OPERATIONS_MINUS ADD CONSTRAINT FK_4178F4079B6B5FBA FOREIGN KEY (account_id) REFERENCES APP_ACCOUNTS (id)');
        $this->addSql('ALTER TABLE APP_OPERATIONS_MINUS ADD CONSTRAINT FK_4178F407EA6AA4E4 FOREIGN KEY (operation_category_id) REFERENCES APP_OPERATION_CATEGORIES (id)');
        $this->addSql('ALTER TABLE APP_OPERATIONS_PLUS ADD CONSTRAINT FK_970934D89B6B5FBA FOREIGN KEY (account_id) REFERENCES APP_ACCOUNTS (id)');
        $this->addSql('ALTER TABLE APP_OPERATIONS_PLUS ADD CONSTRAINT FK_970934D8EA6AA4E4 FOREIGN KEY (operation_category_id) REFERENCES APP_OPERATION_CATEGORIES (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE APP_OPERATIONS_MINUS DROP FOREIGN KEY FK_4178F4079B6B5FBA');
        $this->addSql('ALTER TABLE APP_OPERATIONS_PLUS DROP FOREIGN KEY FK_970934D89B6B5FBA');
        $this->addSql('ALTER TABLE APP_OPERATIONS_MINUS DROP FOREIGN KEY FK_4178F407EA6AA4E4');
        $this->addSql('ALTER TABLE APP_OPERATIONS_PLUS DROP FOREIGN KEY FK_970934D8EA6AA4E4');
        $this->addSql('ALTER TABLE APP_ACCOUNTS DROP FOREIGN KEY FK_D58B35B2A76ED395');
        $this->addSql('DROP TABLE APP_ACCOUNTS');
        $this->addSql('DROP TABLE APP_OPERATION_CATEGORIES');
        $this->addSql('DROP TABLE APP_OPERATIONS_MINUS');
        $this->addSql('DROP TABLE APP_OPERATIONS_PLUS');
        $this->addSql('DROP TABLE user');
    }
}
