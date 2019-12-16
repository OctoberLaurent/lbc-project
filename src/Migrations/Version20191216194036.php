<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191216194036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ads ADD created_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD category_id INT DEFAULT NULL, ADD location_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F620B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F62012469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F62064D218E FOREIGN KEY (location_id) REFERENCES addresses (id)');
        $this->addSql('CREATE INDEX IDX_7EC9F620B03A8386 ON ads (created_by_id)');
        $this->addSql('CREATE INDEX IDX_7EC9F62012469DE2 ON ads (category_id)');
        $this->addSql('CREATE INDEX IDX_7EC9F62064D218E ON ads (location_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F620B03A8386');
        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F62012469DE2');
        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F62064D218E');
        $this->addSql('DROP INDEX IDX_7EC9F620B03A8386 ON ads');
        $this->addSql('DROP INDEX IDX_7EC9F62012469DE2 ON ads');
        $this->addSql('DROP INDEX IDX_7EC9F62064D218E ON ads');
        $this->addSql('ALTER TABLE ads DROP created_by_id, DROP category_id, DROP location_id');
    }
}
