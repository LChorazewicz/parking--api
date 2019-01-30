<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204172342 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO `wojewodztwo` (`id`, `nazwa`, `status`) VALUES 
                                (1, 'dolnośląskie', '1'),
                                (2, 'kujawsko-pomorskie', '1'),
                                (3, 'lubelskie', '1'),
                                (4, 'lubuskie', '1'),
                                (5, 'łódzkie', '1'),
                                (6, 'małopolskie', '1'),
                                (7, 'mazowieckie', '1'),
                                (8, 'opolskie', '1'),
                                (9, 'podkarpackie', '1'),
                                (10, 'podlaskie', '1'),
                                (11, 'pomorskie', '1'),
                                (12, 'świętokrzyskie', '1'),
                                (13, 'warmińsko-mazurskie', '1'),
                                (14, 'wielkopolskie', '1'),
                                (15, 'zachodniopomorskie', '1'),
                                (16, 'śląskie', '1');");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("TRUNCATE TABLE wojewodztwo;");
    }
}
