<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 20.01.19
 * Time: 23:00
 */

namespace App\Model;


use App\DTO\Zgody\ZgodyWejsciowe;

class Zgody
{
    /**
     * @param \App\Entity\Zgody[] $zgodyZBazy
     * @param ZgodyWejsciowe[] $zgodyKlienta
     * @return bool
     */
    public function sprawdzZgody(array $zgodyZBazy, array $zgodyKlienta)
    {
        $czyPoprawne = true;

        $idWymaganychZgodSystemu = []; //[['id' => 1, 'wartosc' => 1]]
        $idNiewymaganychZgodSystemu = [];//[['id' => 1, 'wartosc' => 1]]

        $idWymaganychZgodKlienta = [];//[['id' => 1, 'wartosc' => 1]]
        $idNiewymaganychZgodKlienta = [];//[['id' => 1, 'wartosc' => 1]]

        $idWymaganychZgod = [];//[1,2,3]
        $idNiewymaganychZgod = [];//[1,2,3]

        if(count($zgodyKlienta) <= count($zgodyZBazy)){
            foreach ($zgodyZBazy as $zgoda){
                if($zgoda->getWymagana()) {
                    $idWymaganychZgodSystemu[] = ['id' => $zgoda->getId(), 'wartosc' => $zgoda->getWymagana()];
                    $idWymaganychZgod[] = $zgoda->getId();
                }else{
                    $idNiewymaganychZgodSystemu[] = ['id' => $zgoda->getId(), 'wartosc' => $zgoda->getWymagana()];
                    $idNiewymaganychZgod[] = $zgoda->getId();
                }
            }

            foreach ($zgodyKlienta as $zgoda){
                if(in_array($zgoda->id, $idWymaganychZgod)){
                    $idWymaganychZgodKlienta[] = ['id' => $zgoda->id, 'wartosc' => $zgoda->wartosc];
                    continue;
                }

                if(in_array($zgoda->id, $idNiewymaganychZgod)){
                    $idNiewymaganychZgodKlienta[] = ['id' => $zgoda->id, 'wartosc' => $zgoda->wartosc];
                    continue;
                }
            }

            asort($idWymaganychZgodSystemu);
            asort($idWymaganychZgodKlienta);

            asort($idNiewymaganychZgodSystemu);
            asort($idNiewymaganychZgodKlienta);

            foreach ($idWymaganychZgodSystemu as $index => $wartosc){
                if($czyPoprawne && isset($idWymaganychZgodKlienta[$index]) && $idWymaganychZgodKlienta[$index] == $idWymaganychZgodSystemu[$index]){
                    continue;
                }
                $czyPoprawne = false;
                break;
            }

            foreach ($idNiewymaganychZgodSystemu as $index => $wartosc){
                if($czyPoprawne && isset($idNiewymaganychZgodKlienta[$index])){
                    continue;
                }
                $czyPoprawne = false;
                break;
            }

            if($czyPoprawne && count($idWymaganychZgodKlienta) != count($idWymaganychZgodSystemu)){
                $czyPoprawne = false;
            }

            if($czyPoprawne && count($idNiewymaganychZgodKlienta) != count($idNiewymaganychZgodSystemu)){
                $czyPoprawne = false;
            }
        }

        return $czyPoprawne;
    }
}