<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200907144547 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pret (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, montant_plafond VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, personnel VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, cotisation INT NOT NULL, nombre_enfants INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre_pret (id INT AUTO_INCREMENT NOT NULL, pret_id INT DEFAULT NULL, membre_id INT DEFAULT NULL, montant INT NOT NULL, echeance DATE NOT NULL, INDEX IDX_12CE55461B61704B (pret_id), INDEX IDX_12CE55466A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE remboursement (id INT AUTO_INCREMENT NOT NULL, membre_pret_id INT DEFAULT NULL, montant INT NOT NULL, date DATE NOT NULL, taux_interet DOUBLE PRECISION NOT NULL, INDEX IDX_C0C0D9EFA94672F6 (membre_pret_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cotisation (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, montant INT NOT NULL, date_cotisation DATE NOT NULL, annee LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', INDEX IDX_AE64D2ED6A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ceremonie (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, montant INT NOT NULL, INDEX IDX_F16BAF416A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bureau (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, statut VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre_bureau (id INT AUTO_INCREMENT NOT NULL, membres_id INT DEFAULT NULL, bureau_id INT DEFAULT NULL, poste VARCHAR(255) NOT NULL, INDEX IDX_8C664B7D71128C5C (membres_id), INDEX IDX_8C664B7D32516FE2 (bureau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assistance_sociale (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, montant_fixe INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre_assistance_sociale (id INT AUTO_INCREMENT NOT NULL, assistance_sociale_id INT DEFAULT NULL, membres_id INT DEFAULT NULL, date_operation DATE NOT NULL, montant INT NOT NULL, INDEX IDX_84C8F904A5C4E66D (assistance_sociale_id), INDEX IDX_84C8F90471128C5C (membres_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annee (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE membre_pret ADD CONSTRAINT FK_12CE55461B61704B FOREIGN KEY (pret_id) REFERENCES pret (id)');
        $this->addSql('ALTER TABLE membre_pret ADD CONSTRAINT FK_12CE55466A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE remboursement ADD CONSTRAINT FK_C0C0D9EFA94672F6 FOREIGN KEY (membre_pret_id) REFERENCES membre_pret (id)');
        $this->addSql('ALTER TABLE cotisation ADD CONSTRAINT FK_AE64D2ED6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE ceremonie ADD CONSTRAINT FK_F16BAF416A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE membre_bureau ADD CONSTRAINT FK_8C664B7D71128C5C FOREIGN KEY (membres_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE membre_bureau ADD CONSTRAINT FK_8C664B7D32516FE2 FOREIGN KEY (bureau_id) REFERENCES bureau (id)');
        $this->addSql('ALTER TABLE membre_assistance_sociale ADD CONSTRAINT FK_84C8F904A5C4E66D FOREIGN KEY (assistance_sociale_id) REFERENCES assistance_sociale (id)');
        $this->addSql('ALTER TABLE membre_assistance_sociale ADD CONSTRAINT FK_84C8F90471128C5C FOREIGN KEY (membres_id) REFERENCES membre (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre_assistance_sociale DROP FOREIGN KEY FK_84C8F904A5C4E66D');
        $this->addSql('ALTER TABLE membre_bureau DROP FOREIGN KEY FK_8C664B7D32516FE2');
        $this->addSql('ALTER TABLE ceremonie DROP FOREIGN KEY FK_F16BAF416A99F74A');
        $this->addSql('ALTER TABLE cotisation DROP FOREIGN KEY FK_AE64D2ED6A99F74A');
        $this->addSql('ALTER TABLE membre_assistance_sociale DROP FOREIGN KEY FK_84C8F90471128C5C');
        $this->addSql('ALTER TABLE membre_bureau DROP FOREIGN KEY FK_8C664B7D71128C5C');
        $this->addSql('ALTER TABLE membre_pret DROP FOREIGN KEY FK_12CE55466A99F74A');
        $this->addSql('ALTER TABLE remboursement DROP FOREIGN KEY FK_C0C0D9EFA94672F6');
        $this->addSql('ALTER TABLE membre_pret DROP FOREIGN KEY FK_12CE55461B61704B');
        $this->addSql('DROP TABLE annee');
        $this->addSql('DROP TABLE assistance_sociale');
        $this->addSql('DROP TABLE bureau');
        $this->addSql('DROP TABLE ceremonie');
        $this->addSql('DROP TABLE cotisation');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE membre_assistance_sociale');
        $this->addSql('DROP TABLE membre_bureau');
        $this->addSql('DROP TABLE membre_pret');
        $this->addSql('DROP TABLE pret');
        $this->addSql('DROP TABLE remboursement');
    }
}
