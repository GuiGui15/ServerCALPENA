<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203102249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acces (id INT AUTO_INCREMENT NOT NULL, utile_id INT NOT NULL, auto_id INT NOT NULL, doc_id INT NOT NULL, INDEX IDX_D0F43B107F746B68 (utile_id), INDEX IDX_D0F43B101D55B925 (auto_id), INDEX IDX_D0F43B10895648BC (doc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE autorisation (id INT AUTO_INCREMENT NOT NULL, lecture TINYINT(1) NOT NULL, ecriture TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, chemin VARCHAR(255) NOT NULL, date DATETIME NOT NULL, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B107F746B68 FOREIGN KEY (utile_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B101D55B925 FOREIGN KEY (auto_id) REFERENCES autorisation (id)');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B10895648BC FOREIGN KEY (doc_id) REFERENCES documents (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acces DROP FOREIGN KEY FK_D0F43B101D55B925');
        $this->addSql('ALTER TABLE acces DROP FOREIGN KEY FK_D0F43B10895648BC');
        $this->addSql('ALTER TABLE acces DROP FOREIGN KEY FK_D0F43B107F746B68');
        $this->addSql('DROP TABLE acces');
        $this->addSql('DROP TABLE autorisation');
        $this->addSql('DROP TABLE documents');
        $this->addSql('DROP TABLE utilisateurs');
    }
}
