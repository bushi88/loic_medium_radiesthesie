<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230808110949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD lang VARCHAR(3) NOT NULL');
        $this->addSql('ALTER TABLE category ADD lang VARCHAR(3) NOT NULL');
        $this->addSql('ALTER TABLE home_slider ADD lang VARCHAR(3) NOT NULL');
        $this->addSql('ALTER TABLE zodiaq ADD lang VARCHAR(3) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP lang');
        $this->addSql('ALTER TABLE article DROP lang');
        $this->addSql('ALTER TABLE home_slider DROP lang');
        $this->addSql('ALTER TABLE zodiaq DROP lang');
    }
}
