<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210426095137 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, pwd VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient_lieu RENAME INDEX idlieu TO IDX_7106CDCF5CAA23C7');
        $this->addSql('ALTER TABLE preparation CHANGE idRecette idRecette INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette_astuce RENAME INDEX idastuce TO IDX_10E715796A667F1A');
        $this->addSql('ALTER TABLE recette_categ RENAME INDEX idcateg TO IDX_FF7A49E5144A826E');
        $this->addSql('ALTER TABLE recette_ingredient RENAME INDEX iding TO IDX_17C041A9B1A786E8');
        $this->addSql('ALTER TABLE recette_theme RENAME INDEX idtheme TO IDX_6B816F9E80B1A415');
        $this->addSql('ALTER TABLE recette_ustensile RENAME INDEX idustensile TO IDX_613487D52E08C24D');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE ingredient_lieu RENAME INDEX idx_7106cdcf5caa23c7 TO idLieu');
        $this->addSql('ALTER TABLE preparation CHANGE idRecette idRecette INT NOT NULL');
        $this->addSql('ALTER TABLE recette_astuce RENAME INDEX idx_10e715796a667f1a TO idAstuce');
        $this->addSql('ALTER TABLE recette_categ RENAME INDEX idx_ff7a49e5144a826e TO idCateg');
        $this->addSql('ALTER TABLE recette_ingredient RENAME INDEX idx_17c041a9b1a786e8 TO idIng');
        $this->addSql('ALTER TABLE recette_theme RENAME INDEX idx_6b816f9e80b1a415 TO idTheme');
        $this->addSql('ALTER TABLE recette_ustensile RENAME INDEX idx_613487d52e08c24d TO idUstensile');
    }
}
