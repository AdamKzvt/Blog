<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221229153414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('DROP INDEX categorie_id ON article');
        // $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY categorie_ibfk_1');
        // $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY categorie_ibfk_2');
        // $this->addSql('DROP INDEX user_id ON categorie');
        $this->addSql('ALTER TABLE categorie ADD nom_user VARCHAR(255) NOT NULL');
        // $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY commentaire_ibfk_2');
        // $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY commentaire_ibfk_1');
        // $this->addSql('DROP INDEX article_id ON commentaire');
        // $this->addSql('DROP INDEX user_id ON commentaire');
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE INDEX categorie_id ON article (categorie_id)');
        $this->addSql('ALTER TABLE categorie DROP nom_user');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT categorie_ibfk_1 FOREIGN KEY (id) REFERENCES article (categorie_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT categorie_ibfk_2 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX user_id ON categorie (user_id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT commentaire_ibfk_2 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT commentaire_ibfk_1 FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX article_id ON commentaire (article_id)');
        $this->addSql('CREATE INDEX user_id ON commentaire (user_id)');
    }
}
