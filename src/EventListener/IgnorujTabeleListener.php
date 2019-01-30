<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 13.01.19
 * Time: 12:00
 */

namespace App\EventListener;


use Doctrine\Bundle\DoctrineBundle\Command\Proxy\UpdateSchemaDoctrineCommand;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;

class IgnorujTabeleListener extends UpdateSchemaDoctrineCommand
{
    private $ignoredEntities = [
        'App\Entity\V_AdresSumaKontrolna',
    ];

    /**
     * Remove ignored tables /entities from Schema
     *
     * @param GenerateSchemaEventArgs $args
     */
    public function postGenerateSchema(GenerateSchemaEventArgs $args)
    {
        $schema = $args->getSchema();
        $em = $args->getEntityManager();


        $ignoredTables = [];
        foreach ($this->ignoredEntities as $entityName) {
            $ignoredTables[] = $em->getClassMetadata($entityName)->getTableName();
        }


        foreach ($schema->getTables() as $table) {

            if (in_array($table->getName(), $ignoredTables)) {
                // remove table from schema
                $schema->dropTable($table->getName());
            }
        }
    }
}