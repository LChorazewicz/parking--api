<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190120224159 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `zgody` (`id`, `nazwa`, `tresc`, `status`, `wymagana`) VALUES 
                      (NULL, 'Zgoda marketingowa', 'Wyrażam zgodę na przetwarzanie danych osobowych w celach marketingowych ', '1', '0'), 
                      (NULL, 'Zgoda statystyczna', 'Wyrażam zgodę na przetwarzanie danych osobowych w celach Statystycznych', '1', '0'), 
                      (NULL, 'Zgoda na użycie środków komunikacji elektronicznej ', 'Wyrażam zgodę na użycie środków komunikacji elektronicznej ', '1', '1'), 
                      (NULL, 'Zgoda na przetwarzanie danych osobowych w celach marketingowych przez podmioty trzecie', 'Wyrażam zgodę na przetwarzanie danych osobowych w celach marketingowych przez podmioty trzecie', '1', '0');");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('TRUNCATE TABLE zgody');
    }
}
