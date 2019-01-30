<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204184318 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("CREATE VIEW `v_adres_suma_kontrolna` AS select `w`.`id` as wojewodztwo, `m`.`id` as miasto, `u`.`id` as ulica, concat(`w`.`id`,'-',`m`.`id`,'-',`u`.`id`) AS `suma_kontrolna` from ((`parking`.`wojewodztwo` `w` join `parking`.`miasto` `m` on((`m`.`id_wojewodztwa` = `w`.`id`))) join `parking`.`ulica` `u` on((`u`.`id_miasta` = `m`.`id`)))");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DROP VIEW v_adres_suma_kontrolna");
    }
}
