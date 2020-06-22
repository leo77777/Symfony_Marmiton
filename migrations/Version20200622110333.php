<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200622110333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compose (id INT AUTO_INCREMENT NOT NULL, recette_id INT DEFAULT NULL, ingredient_id INT DEFAULT NULL, qte_une_personne VARCHAR(50) NOT NULL, INDEX IDX_AE4C141689312FE9 (recette_id), INDEX IDX_AE4C1416933FE08C (ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, nom_ingredient VARCHAR(255) NOT NULL, couleur VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compose ADD CONSTRAINT FK_AE4C141689312FE9 FOREIGN KEY (recette_id) REFERENCES recettes (id)');
        $this->addSql('ALTER TABLE compose ADD CONSTRAINT FK_AE4C1416933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredients (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compose DROP FOREIGN KEY FK_AE4C1416933FE08C');
        $this->addSql('DROP TABLE compose');
        $this->addSql('DROP TABLE ingredients');
    }
}
