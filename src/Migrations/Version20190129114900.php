<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190129114900 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO `ustawienia` (`id`, `zmienna`, `wartosc`, `status`, `opis`) VALUES 
        (NULL, 'data_restartu_sesji', NULL, '1', 'Data, która wymusza restart sesji dla wniosków które ostatni statusu osiągnięty <= data_restartu_sesji, format d-m-Y H:i:s');");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DELETE FROM ustawienia WHERE zmienna = 'data_restartu_sesji';");
    }
}
