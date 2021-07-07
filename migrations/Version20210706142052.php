<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706142052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, datecreate DATE NOT NULL, dateupdate DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, idgroup_id INT NOT NULL, idmember_id INT NOT NULL, text LONGBLOB NOT NULL, datecreate DATE NOT NULL, INDEX IDX_B6BD307F5481914A (idgroup_id), INDEX IDX_B6BD307FB8C7A0B (idmember_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F5481914A FOREIGN KEY (idgroup_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FB8C7A0B FOREIGN KEY (idmember_id) REFERENCES member (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F5481914A');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FB8C7A0B');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE message');
    }
}
