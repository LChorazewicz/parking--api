<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190127093453 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("ALTER TABLE wnioski ADD id_wniosku VARCHAR(36) NOT NULL AFTER id_klienta;");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DROP COLUMN id_wniosku;");
    }
}
