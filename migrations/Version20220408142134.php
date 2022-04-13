<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408142134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandeproduit CHANGE productID productID INT DEFAULT NULL, CHANGE orderID orderID INT DEFAULT NULL');
        $this->addSql('ALTER TABLE joueur CHANGE team team INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY fk_eq2');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY fk_tournois');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY fk_equipe1');
        $this->addSql('ALTER TABLE partie CHANGE id_tournoi id_tournoi INT DEFAULT NULL, CHANGE id_equipe1 id_equipe1 INT DEFAULT NULL, CHANGE id_equipe2 id_equipe2 INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D30B8EB96 FOREIGN KEY (id_equipe1) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3DA9B1BA2C FOREIGN KEY (id_equipe2) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3DC63270AF FOREIGN KEY (id_tournoi) REFERENCES tournois (id)');
        $this->addSql('ALTER TABLE reponse_reclam CHANGE id_rec id_rec INT DEFAULT NULL, CHANGE id id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sponsors CHANGE Société Société VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandeproduit CHANGE productID productID INT NOT NULL, CHANGE orderID orderID INT NOT NULL');
        $this->addSql('ALTER TABLE joueur CHANGE team team INT NOT NULL');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D30B8EB96');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3DA9B1BA2C');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3DC63270AF');
        $this->addSql('ALTER TABLE partie CHANGE id_equipe1 id_equipe1 INT NOT NULL, CHANGE id_equipe2 id_equipe2 INT NOT NULL, CHANGE id_tournoi id_tournoi INT NOT NULL');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT fk_eq2 FOREIGN KEY (id_equipe2) REFERENCES equipe (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT fk_tournois FOREIGN KEY (id_tournoi) REFERENCES tournois (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT fk_equipe1 FOREIGN KEY (id_equipe1) REFERENCES equipe (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse_reclam CHANGE id id INT NOT NULL, CHANGE id_rec id_rec INT NOT NULL');
        $this->addSql('ALTER TABLE sponsors CHANGE Société Société VARCHAR(50) DEFAULT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE utilisateur CHANGE id id INT NOT NULL');
    }
}
