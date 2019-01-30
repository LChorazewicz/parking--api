<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204175747 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO `ulica` (`id`, `id_miasta`, `nazwa`, `status`) VALUES 
                              (NULL, '1', 'Kilińskiego', '1'),
                              (NULL, '1', 'Kaczyńskiego', '1'),
                              (NULL, '1', 'Sikorskiego', '1'),
                              (NULL, '1', 'Sienkiewicza', '1'),
                              (NULL, '1', 'Pileckiego', '1'),
                              (NULL, '1', 'Romanowicza', '1'),
                              (NULL, '1', 'Sochaczewskiego', '1'),
                              (NULL, '1', 'Blachnickiego', '1'),
                              (NULL, '1', 'Warszawska', '1'),
                                                                  
                              (NULL, '2', 'Kilińskiego', '1'),
                              (NULL, '2', 'Kaczyńskiego', '1'),
                              (NULL, '2', 'Sikorskiego', '1'),
                              (NULL, '2', 'Sienkiewicza', '1'),
                              (NULL, '2', 'Pileckiego', '1'),
                              (NULL, '2', 'Romanowicza', '1'),
                              (NULL, '2', 'Sochaczewskiego', '1'),
                              (NULL, '2', 'Blachnickiego', '1'),
                              (NULL, '2', 'Warszawska', '1'),
                              
                              (NULL, '3', 'Kilińskiego', '1'),
                              (NULL, '3', 'Kaczyńskiego', '1'),
                              (NULL, '3', 'Sikorskiego', '1'),
                              (NULL, '3', 'Sienkiewicza', '1'),
                              (NULL, '3', 'Pileckiego', '1'),
                              (NULL, '3', 'Romanowicza', '1'),
                              (NULL, '3', 'Sochaczewskiego', '1'),
                              (NULL, '3', 'Blachnickiego', '1'),
                              (NULL, '3', 'Warszawska', '1'),
                               
                              (NULL, '4', 'Kilińskiego', '1'),
                              (NULL, '4', 'Kaczyńskiego', '1'),
                              (NULL, '4', 'Sikorskiego', '1'),
                              (NULL, '4', 'Sienkiewicza', '1'),
                              (NULL, '4', 'Pileckiego', '1'),
                              (NULL, '4', 'Romanowicza', '1'),
                              (NULL, '4', 'Sochaczewskiego', '1'),
                              (NULL, '4', 'Blachnickiego', '1'),
                              (NULL, '4', 'Warszawska', '1'),
                                                                  
                              (NULL, '5', 'Kilińskiego', '1'),
                              (NULL, '5', 'Kaczyńskiego', '1'),
                              (NULL, '5', 'Sikorskiego', '1'),
                              (NULL, '5', 'Sienkiewicza', '1'),
                              (NULL, '5', 'Pileckiego', '1'),
                              (NULL, '5', 'Romanowicza', '1'),
                              (NULL, '5', 'Sochaczewskiego', '1'),
                              (NULL, '5', 'Blachnickiego', '1'),
                              (NULL, '5', 'Warszawska', '1'),
                              
                              (NULL, '6', 'Kilińskiego', '1'),
                              (NULL, '6', 'Kaczyńskiego', '1'),
                              (NULL, '6', 'Sikorskiego', '1'),
                              (NULL, '6', 'Sienkiewicza', '1'),
                              (NULL, '6', 'Pileckiego', '1'),
                              (NULL, '6', 'Romanowicza', '1'),
                              (NULL, '6', 'Sochaczewskiego', '1'),
                              (NULL, '6', 'Blachnickiego', '1'),
                              (NULL, '6', 'Warszawska', '1'),
                                                                  
                              (NULL, '7', 'Kilińskiego', '1'),
                              (NULL, '7', 'Kaczyńskiego', '1'),
                              (NULL, '7', 'Sikorskiego', '1'),
                              (NULL, '7', 'Sienkiewicza', '1'),
                              (NULL, '7', 'Pileckiego', '1'),
                              (NULL, '7', 'Romanowicza', '1'),
                              (NULL, '7', 'Sochaczewskiego', '1'),
                              (NULL, '7', 'Blachnickiego', '1'),
                              (NULL, '7', 'Warszawska', '1'),
                                                                  
                              (NULL, '8', 'Kilińskiego', '1'),
                              (NULL, '8', 'Kaczyńskiego', '1'),
                              (NULL, '8', 'Sikorskiego', '1'),
                              (NULL, '8', 'Sienkiewicza', '1'),
                              (NULL, '8', 'Pileckiego', '1'),
                              (NULL, '8', 'Romanowicza', '1'),
                              (NULL, '8', 'Sochaczewskiego', '1'),
                              (NULL, '8', 'Blachnickiego', '1'),
                              (NULL, '8', 'Warszawska', '1'),
                              
                              (NULL, '9', 'Kilińskiego', '1'),
                              (NULL, '9', 'Kaczyńskiego', '1'),
                              (NULL, '9', 'Sikorskiego', '1'),
                              (NULL, '9', 'Sienkiewicza', '1'),
                              (NULL, '9', 'Pileckiego', '1'),
                              (NULL, '9', 'Romanowicza', '1'),
                              (NULL, '9', 'Sochaczewskiego', '1'),
                              (NULL, '9', 'Blachnickiego', '1'),
                              (NULL, '9', 'Warszawska', '1'),                                    
                                                                  
                              (NULL, '10', 'Kilińskiego', '1'),
                              (NULL, '10', 'Kaczyńskiego', '1'),
                              (NULL, '10', 'Sikorskiego', '1'),
                              (NULL, '10', 'Sienkiewicza', '1'),
                              (NULL, '10', 'Pileckiego', '1'),
                              (NULL, '10', 'Romanowicza', '1'),
                              (NULL, '10', 'Sochaczewskiego', '1'),
                              (NULL, '10', 'Blachnickiego', '1'),
                              (NULL, '10', 'Warszawska', '1'),
                                                                  
                              (NULL, '11', 'Kilińskiego', '1'),
                              (NULL, '11', 'Kaczyńskiego', '1'),
                              (NULL, '11', 'Sikorskiego', '1'),
                              (NULL, '11', 'Sienkiewicza', '1'),
                              (NULL, '11', 'Pileckiego', '1'),
                              (NULL, '11', 'Romanowicza', '1'),
                              (NULL, '11', 'Sochaczewskiego', '1'),
                              (NULL, '11', 'Blachnickiego', '1'),
                              (NULL, '11', 'Warszawska', '1'),
                              
                              (NULL, '12', 'Kilińskiego', '1'),
                              (NULL, '12', 'Kaczyńskiego', '1'),
                              (NULL, '12', 'Sikorskiego', '1'),
                              (NULL, '12', 'Sienkiewicza', '1'),
                              (NULL, '12', 'Pileckiego', '1'),
                              (NULL, '12', 'Romanowicza', '1'),
                              (NULL, '12', 'Sochaczewskiego', '1'),
                              (NULL, '12', 'Blachnickiego', '1'),
                              (NULL, '12', 'Warszawska', '1'),                                   
                                                                  
                              (NULL, '13', 'Kilińskiego', '1'),
                              (NULL, '13', 'Kaczyńskiego', '1'),
                              (NULL, '13', 'Sikorskiego', '1'),
                              (NULL, '13', 'Sienkiewicza', '1'),
                              (NULL, '13', 'Pileckiego', '1'),
                              (NULL, '13', 'Romanowicza', '1'),
                              (NULL, '13', 'Sochaczewskiego', '1'),
                              (NULL, '13', 'Blachnickiego', '1'),
                              (NULL, '13', 'Warszawska', '1'),
                                                                  
                              (NULL, '14', 'Kilińskiego', '1'),
                              (NULL, '14', 'Kaczyńskiego', '1'),
                              (NULL, '14', 'Sikorskiego', '1'),
                              (NULL, '14', 'Sienkiewicza', '1'),
                              (NULL, '14', 'Pileckiego', '1'),
                              (NULL, '14', 'Romanowicza', '1'),
                              (NULL, '14', 'Sochaczewskiego', '1'),
                              (NULL, '14', 'Blachnickiego', '1'),
                              (NULL, '14', 'Warszawska', '1'),
                              
                              (NULL, '15', 'Kilińskiego', '1'),
                              (NULL, '15', 'Kaczyńskiego', '1'),
                              (NULL, '15', 'Sikorskiego', '1'),
                              (NULL, '15', 'Sienkiewicza', '1'),
                              (NULL, '15', 'Pileckiego', '1'),
                              (NULL, '15', 'Romanowicza', '1'),
                              (NULL, '15', 'Sochaczewskiego', '1'),
                              (NULL, '15', 'Blachnickiego', '1'),
                              (NULL, '15', 'Warszawska', '1'),  
                                                                  
                              (NULL, '16', 'Kilińskiego', '1'),
                              (NULL, '16', 'Kaczyńskiego', '1'),
                              (NULL, '16', 'Sikorskiego', '1'),
                              (NULL, '16', 'Sienkiewicza', '1'),
                              (NULL, '16', 'Pileckiego', '1'),
                              (NULL, '16', 'Romanowicza', '1'),
                              (NULL, '16', 'Sochaczewskiego', '1'),
                              (NULL, '16', 'Blachnickiego', '1'),
                              (NULL, '16', 'Warszawska', '1');");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("TRUNCATE TABLE ulica;");
    }
}
