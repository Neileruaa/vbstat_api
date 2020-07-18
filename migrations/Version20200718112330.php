<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200718112330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entraineur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entraineur_equipe (entraineur_id INT NOT NULL, equipe_id INT NOT NULL, INDEX IDX_97E34CE3F8478A1 (entraineur_id), INDEX IDX_97E34CE36D861B89 (equipe_id), PRIMARY KEY(entraineur_id, equipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, position_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, num VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, INDEX IDX_FD71A9C5DD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point (id INT AUTO_INCREMENT NOT NULL, sets_id INT DEFAULT NULL, joueur_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_B7A5F324F40DDE7E (sets_id), INDEX IDX_B7A5F324A9E2D76C (joueur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `set` (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, score_a INT NOT NULL, score_b INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entraineur_equipe ADD CONSTRAINT FK_97E34CE3F8478A1 FOREIGN KEY (entraineur_id) REFERENCES entraineur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entraineur_equipe ADD CONSTRAINT FK_97E34CE36D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F324F40DDE7E FOREIGN KEY (sets_id) REFERENCES `set` (id)');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F324A9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE `match` ADD equipe_a_id INT NOT NULL, ADD equipe_b_id INT NOT NULL, ADD salle_id INT DEFAULT NULL, ADD sets_id INT DEFAULT NULL, ADD date DATE DEFAULT NULL, ADD score_a INT DEFAULT NULL, ADD score_b INT DEFAULT NULL, DROP test_field');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC5053297C2A6 FOREIGN KEY (equipe_a_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC50520226D48 FOREIGN KEY (equipe_b_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505F40DDE7E FOREIGN KEY (sets_id) REFERENCES `set` (id)');
        $this->addSql('CREATE INDEX IDX_7A5BC5053297C2A6 ON `match` (equipe_a_id)');
        $this->addSql('CREATE INDEX IDX_7A5BC50520226D48 ON `match` (equipe_b_id)');
        $this->addSql('CREATE INDEX IDX_7A5BC505DC304035 ON `match` (salle_id)');
        $this->addSql('CREATE INDEX IDX_7A5BC505F40DDE7E ON `match` (sets_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entraineur_equipe DROP FOREIGN KEY FK_97E34CE3F8478A1');
        $this->addSql('ALTER TABLE entraineur_equipe DROP FOREIGN KEY FK_97E34CE36D861B89');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC5053297C2A6');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC50520226D48');
        $this->addSql('ALTER TABLE point DROP FOREIGN KEY FK_B7A5F324A9E2D76C');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5DD842E46');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505DC304035');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505F40DDE7E');
        $this->addSql('ALTER TABLE point DROP FOREIGN KEY FK_B7A5F324F40DDE7E');
        $this->addSql('DROP TABLE entraineur');
        $this->addSql('DROP TABLE entraineur_equipe');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE point');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE `set`');
        $this->addSql('DROP INDEX IDX_7A5BC5053297C2A6 ON `match`');
        $this->addSql('DROP INDEX IDX_7A5BC50520226D48 ON `match`');
        $this->addSql('DROP INDEX IDX_7A5BC505DC304035 ON `match`');
        $this->addSql('DROP INDEX IDX_7A5BC505F40DDE7E ON `match`');
        $this->addSql('ALTER TABLE `match` ADD test_field VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP equipe_a_id, DROP equipe_b_id, DROP salle_id, DROP sets_id, DROP date, DROP score_a, DROP score_b');
    }
}
