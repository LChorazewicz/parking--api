<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204173249 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO `miasto` (`id`, `id_wojewodztwa`, `nazwa`, `status`) VALUES 
                              (NULL, '1', 'Wrocław', '1'),
                              (NULL, '1', 'Wałbrzych', '1'),
                              (NULL, '1', 'Legnica', '1'),
                              (NULL, '1', 'Jelenia Góra', '1'),
                              (NULL, '1', 'Lubin', '1'),
                              (NULL, '2', 'Aleksandrów Kujawski', '1'),
                              (NULL, '2', 'Barcin', '1'),
                              (NULL, '2', 'Brodnica', '1'),
                              (NULL, '2', 'Chełmno', '1'),
                              (NULL, '2', 'Rypin', '1'),
                              (NULL, '3', 'Chełm', '1'),
                              (NULL, '3', 'Dębin', '1'),
                              (NULL, '3', 'Kock', '1'),
                              (NULL, '3', 'Krasnobród', '1'),
                              (NULL, '3', 'Lublin', '1'),
                              (NULL, '4', 'Babimost', '1'),
                              (NULL, '4', 'Lubsko', '1'),
                              (NULL, '4', 'Łęknica', '1'),
                              (NULL, '4', 'Kożuchów', '1'),
                              (NULL, '4', 'Gubin', '1'),
                              (NULL, '5', 'Bełchatów', '1'),
                              (NULL, '5', 'Głowno', '1'),
                              (NULL, '5', 'Kutno', '1'),
                              (NULL, '5', 'Ozorków', '1'),
                              (NULL, '5', 'Łódź', '1'),
                              (NULL, '6', 'Chełmek', '1'),
                              (NULL, '6', 'Czchów', '1'),
                              (NULL, '6', 'Gorlice', '1'),
                              (NULL, '6', 'Tarnów', '1'),
                              (NULL, '6', 'Olkusz', '1'),
                              (NULL, '7', 'Warszawa', '1'),
                              (NULL, '7', 'Ostrołęka', '1'),
                              (NULL, '7', 'Pułtusk', '1'),
                              (NULL, '7', 'Antonie', '1'),
                              (NULL, '7', 'Różan', '1'),
                              (NULL, '8', 'Byczyna', '1'),
                              (NULL, '8', 'Gogolin', '1'),
                              (NULL, '8', 'Kluczbork', '1'),
                              (NULL, '8', 'Nysa', '1'),
                              (NULL, '8', 'Opole', '1'),
                              (NULL, '9', 'Narol', '1'),
                              (NULL, '9', 'Nisko', '1'),
                              (NULL, '9', 'Pruchnik', '1'),
                              (NULL, '9', 'Radymno', '1'),
                              (NULL, '9', 'Rzeszów', '1'),
                              (NULL, '10', 'Łomża', '1'),
                              (NULL, '10', 'Augustów', '1'),
                              (NULL, '10', 'Grajewo', '1'),
                              (NULL, '10', 'Kolno', '1'),
                              (NULL, '10', 'Nowogród', '1'),
                              (NULL, '11', 'Bytów', '1'),
                              (NULL, '11', 'Czersk', '1'),
                              (NULL, '11', 'Gdańsk', '1'),
                              (NULL, '11', 'Hel', '1'),
                              (NULL, '11', 'Sopot', '1'),
                              (NULL, '12', 'Jędrzejów', '1'),
                              (NULL, '12', 'Kielce', '1'),
                              (NULL, '12', 'Końskie', '1'),
                              (NULL, '12', 'Pińczów', '1'),
                              (NULL, '12', 'Ożarów', '1'),
                              (NULL, '13', 'Biskupiec', '1'),
                              (NULL, '13', 'Dobre miasto', '1'),
                              (NULL, '13', 'Ełk', '1'),
                              (NULL, '13', 'Iława', '1'),
                              (NULL, '13', 'Olsztyn', '1'),
                              (NULL, '14', 'Poznań', '1'),
                              (NULL, '14', 'Kalisz', '1'),
                              (NULL, '14', 'Konin', '1'),
                              (NULL, '14', 'Piła', '1'),
                              (NULL, '14', 'Gniezno', '1'),
                              (NULL, '15', 'Białogard', '1'),
                              (NULL, '15', 'Człopa', '1'),
                              (NULL, '15', 'Gryfice', '1'),
                              (NULL, '15', 'Ińsko', '1'),
                              (NULL, '15', 'Nowe Warpno', '1'),
                              (NULL, '16', 'Bytom', '1'),
                              (NULL, '16', 'Gliwice', '1'),
                              (NULL, '16', 'Jaworzno', '1'),
                              (NULL, '16', 'Lubliniec', '1'),
                              (NULL, '16', 'Pszów', '1');");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("TRUNCATE TABLE miasto;");
    }
}
