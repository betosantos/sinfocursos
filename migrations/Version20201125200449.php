<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201125200449 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, descricao LONGTEXT DEFAULT NULL, criado DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE curso (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, descricao LONGTEXT DEFAULT NULL, imagem VARCHAR(255) DEFAULT NULL, criado DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE curso_categoria (curso_id INT NOT NULL, categoria_id INT NOT NULL, INDEX IDX_400AD22687CB4A1F (curso_id), INDEX IDX_400AD2263397707A (categoria_id), PRIMARY KEY(curso_id, categoria_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, criado DATE DEFAULT NULL, status TINYINT(1) NOT NULL, roles VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE curso_categoria ADD CONSTRAINT FK_400AD22687CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE curso_categoria ADD CONSTRAINT FK_400AD2263397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE curso_categoria DROP FOREIGN KEY FK_400AD2263397707A');
        $this->addSql('ALTER TABLE curso_categoria DROP FOREIGN KEY FK_400AD22687CB4A1F');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE curso');
        $this->addSql('DROP TABLE curso_categoria');
        $this->addSql('DROP TABLE usuario');
    }
}
