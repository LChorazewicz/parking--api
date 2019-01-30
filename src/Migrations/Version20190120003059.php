<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190120003059 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `ustawienia` (`id`, `zmienna`, `wartosc`, `status`, `opis`) VALUES
                        (1, 'data_systemowa', NULL, 1, 'Data systemowa - format: 20-01-2019'),
                        (2, 'ile_dni_na_rezerwacje_od_dzis', '15', 1, 'Ile dni po dzisiejszym dniu można dokonać rezerwacji');");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('TRUNCATE TABLE ustawienia');
    }
}
