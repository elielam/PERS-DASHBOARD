<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180422234923 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE APP_TODOS (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, todo_cat_id INT DEFAULT NULL, libelle VARCHAR(40) NOT NULL, description VARCHAR(200) DEFAULT NULL, datetime DATETIME NOT NULL, state INT NOT NULL, INDEX IDX_583FF441A76ED395 (user_id), INDEX IDX_583FF4418F263C61 (todo_cat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todo_category (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE APP_TODOS ADD CONSTRAINT FK_583FF441A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE APP_TODOS ADD CONSTRAINT FK_583FF4418F263C61 FOREIGN KEY (todo_cat_id) REFERENCES todo_category (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE APP_TODOS DROP FOREIGN KEY FK_583FF4418F263C61');
        $this->addSql('DROP TABLE APP_TODOS');
        $this->addSql('DROP TABLE todo_category');
    }
}
